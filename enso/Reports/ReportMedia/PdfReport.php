<?php

namespace LaravelEnso\Reports\ReportMedia;

use Carbon\Carbon;
use LaravelEnso\Reports\ReportGenerator;

class PdfReport extends ReportGenerator
{
    public function make($v = false)
    {
        $headers = $this->headers;
        $query = $this->query;
        $columns = $this->columns;
        $limit = $this->limit;
        $groupByArr = $this->groupByArr;
        $orientation = $this->orientation;
        $editColumns = $this->editColumns;
        $showTotalColumns = $this->showTotalColumns;
        $styles = $this->styles;
        $showHeader = $this->showHeader;
        $showMeta = $this->showMeta;
        $showNumColumn = $this->showNumColumn;
        $applyFlush = $this->applyFlush;

        if ($this->withoutManipulation) {
            $html = \View::make('report-generator-view::without-manipulation-pdf-template',
                compact('headers', 'columns', 'showTotalColumns', 'query', 'limit', 'orientation', 'showHeader',
                    'showMeta', 'applyFlush', 'showNumColumn'))->render();
        } else {
            $html = \View::make('report-generator-view::general-pdf-template',
                compact('headers', 'columns', 'editColumns', 'showTotalColumns', 'styles', 'query', 'limit',
                    'groupByArr', 'orientation', 'showHeader', 'showMeta', 'applyFlush', 'showNumColumn'))->render();
        }

        try {
            Carbon::setLocale('pt_BR');
            $today = Carbon::create();
            $pdf = \App::make('snappy.pdf.wrapper');
            $pdf->setOption('footer-font-size', 10);
            $pdf->setOption('footer-left', 'Página [page] de [topage]');
            $pdf->setOption('footer-right', 'Gerado em: ' . "{$today->day} de {$today->localeMonth} de {$today->year} as {$today->format('H:i')}");
        } catch (\ReflectionException $e) {
            //throw new \Exception('Please install barryvdh/laravel-snappy to generate PDF Report!');
        }

        if ($v) {
            return \View::make('report-generator-view::general-pdf-template',
                compact('headers', 'columns', 'editColumns', 'showTotalColumns', 'styles', 'query', 'limit',
                    'groupByArr', 'orientation', 'showHeader', 'showMeta', 'applyFlush', 'showNumColumn'));
        }
        return $pdf->loadHTML($html)->setPaper($this->paper, $orientation);
    }

    public function stream()
    {
        return $this->make()->inline();
    }

    public function download($filename)
    {
        return $this->make()->download($filename . '.pdf');
    }
}
