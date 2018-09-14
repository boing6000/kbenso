<?php

namespace LaravelEnso\Charts\app\Classes;

class PieChart extends PiePolarOrDoughnutChart
{
    public function __construct()
    {
        parent::__construct();

        $this->type('pie')
            ->ratio(1);
        $this->options['responsive'] = true;
        $this->options['maintainAspectRatio'] = false;

    }
}
