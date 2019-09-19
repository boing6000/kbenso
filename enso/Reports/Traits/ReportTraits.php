<?php
/**
 * Created by PhpStorm.
 * User: boing
 * Date: 10/01/2019
 * Time: 09:13
 */

namespace LaravelEnso\Reports\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use LaravelEnso\Reports\Facades\PdfReportFacade as PdfReport;
use LaravelEnso\Reports\Facades\ExcelReportFacade as ExcelReport;

trait ReportTraits
{
    protected $meta = [];
    protected $columns = [];
    protected $title = '';
    /**
     * @var Builder $queryBuilder
     */
    protected $queryBuilder;
    protected $data = [];
    protected $excel = false;

    /**
     * @return \LaravelEnso\Reports\ReportMedia\PdfReport
     */
    public function toPDF($isArray = false, $columns = ['*'])
    {
        $data = $isArray ? collect($this->data) : $this->queryBuilder->select($columns);
        //dd($this->queryBuilder->toSql(), $this->queryBuilder->getBindings());
        return PdfReport::of($this->title, $this->meta, $data, $this->columns);
    }

    /**
     * @return \LaravelEnso\Reports\ReportMedia\ExcelReport
     */
    public function toXSLX()
    {
        return ExcelReport::of($this->title, $this->meta, $this->queryBuilder->select(), $this->columns);
    }

    protected function addMeta($label, $value)
    {
        $this->meta[$label] = $value;
    }

    protected function whereHas($column, $value, $ope = '=', $and = true){
        $joins = collect(explode('.', $column));
        $and = $and ? 'and' : 'or';
        $param = $joins->pop();
        $this->queryBuilder->whereHas(implode('.', $joins->all()), function (Builder $q) use ($value, $ope, $and, $param){
            switch ($ope){
                case 'in':
                    $q->whereIn($param, $value, $and);
                    break;
                default:
                    $q->where($param, $ope, $value, $and);
                    break;
            }
        });
    }

    protected function whereHasMulti($wheres){
        $this->queryBuilder->where(function(Builder $subQuery) use($wheres){
            foreach ($wheres as $where){
                $joins = collect(explode('.', $where[0]));
                $and = $where[3] ? 'and' : 'or';
                $param = $joins->pop();
                $value = $where[1];
                $ope = $where[2];
                $subQuery->whereHas(implode('.', $joins->all()), function (Builder $q) use ($value, $ope, $and, $param){
                    switch ($ope){
                        case 'in':
                            $q->whereIn($param, $value, $and);
                            break;
                        default:
                            $q->where($param, $ope, $value, $and);
                            break;
                    }
                });
            }
        });
    }

    protected function orderBy($column, $dir = 'ASC', $related = false)
    {
        if($related){
            $joins = collect(explode('.', $column));
            $param = $joins->pop();
            $this->queryBuilder->whereHas(implode('.', $joins->all()), function (Builder $q) use ($dir, $param){
                $q->orderBy($param, $dir);
            });
        }else {
            $this->queryBuilder->orderBy($column, $dir);
        }
    }

    protected function getDateStr($key, $label)
    {
        $dates = json_decode(request()->get($key), true);
        $dateStr = $dates['min'] !== null || $dates['max'] !== null ? '(' : '( Todos )';
        $dateStr .= $dates['min'] !== null ? $dates['min'] : '';
        $dateStr .= $dates['min'] !== null && $dates['max'] !== null ? ' à ' : '';
        $dateStr .= $dates['min'] == null && $dates['max'] !== null ? ' até ' : '';
        $dateStr .= $dates['max'] !== null ? $dates['max'] : '';
        $dateStr .= $dates['min'] !== null || $dates['max'] !== null ? ')' : '';

        $this->meta[$label] = $dateStr;
    }

    protected function betweenDates($key, $column = null, $related = false)
    {
        $dates = request()->get($key);
        $column = isset($column) ? $column : $key;

        if (is_string($dates)) {
            $dates = json_decode($dates, true);
        }
        $min = $dates['min'] !== null ? Carbon::createFromFormat('d/m/Y', $dates['min'])->format('Y-m-d') : null;
        $max = $dates['max'] !== null ? Carbon::createFromFormat('d/m/Y', $dates['max'])->format('Y-m-d') : null;

        if ($related) {
            $joins = collect(explode('.', $column));
            for ($i = 0; $i < $joins->count() - 1; $i++) {
                $this->queryBuilder->whereHas($joins->get($i), function (Builder $q) use ($joins, $i, $min, $max) {
                    if ($i === $joins->count() - 2) {
                        if (isset($min)) {
                            $q->whereDate($joins->get($joins->count() - 1), '>=', $min);
                        }
                        if (isset($max)) {
                            $q->whereDate($joins->get($joins->count() - 1), '<=', $max);
                        }
                    }
                });
            }
        } else {
            if (isset($min)) {
                $this->queryBuilder->whereDate($column, '>=', $min);
            }
            if (isset($max)) {
                $this->queryBuilder->whereDate($column, '<=', $max);
            }
        }

    }
}