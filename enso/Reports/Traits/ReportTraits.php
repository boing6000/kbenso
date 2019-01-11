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

    /**
     * @return \LaravelEnso\Reports\ReportMedia\PdfReport
     */
    public function toPDF()
    {

        return PdfReport::of($this->title, $this->meta, $this->queryBuilder->select(), $this->columns);
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

    protected function orderBy($column, $dir = 'ASC', $related = false)
    {
        if($related){
            $joins = collect(explode('.', $column));
            for ($i = 0; $i < $joins->count() - 1; $i++) {
                $this->queryBuilder->whereHas($joins->get($i), function (Builder $q) use ($joins, $i, $dir) {
                    if ($i === $joins->count() - 2) {
                        $q->orderBy($joins->get($joins->count() - 1), $dir);
                    }
                });
            }
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
                            $q->where($joins->get($joins->count() - 1), '>=', $min);
                        }
                        if (isset($max)) {
                            $q->where($joins->get($joins->count() - 1), '<=', $max);
                        }
                    }
                });
            }
        } else {
            if (isset($min)) {
                $this->queryBuilder->where($column, '>=', $min);
            }
            if (isset($max)) {
                $this->queryBuilder->where($column, '<=', $max);
            }
        }

    }
}