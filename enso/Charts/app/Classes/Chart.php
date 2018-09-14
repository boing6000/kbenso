<?php

namespace LaravelEnso\Charts\app\Classes;

use LaravelEnso\Helpers\app\Classes\Obj;

abstract class Chart
{
    private const Opacity = '0.25';

    protected $datasets;
    protected $labels;
    protected $colors;
    protected $data = [];
    protected $title;
    protected $type;
    protected $options;

    public function __construct()
    {
        $this->colors();
        $this->options['tooltips'] = [
            'enabled' => false
        ];

    }

    public function get()
    {
        $this->build();

        return $this->response();
    }

    abstract protected function build();

    abstract protected function response();

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function labels(array $labels)
    {
        $this->labels = $labels;

        return $this;
    }

    public function datasets(array $datasets)
    {
        $this->datasets = $datasets;

        return $this;
    }

    public function ratio(float $ratio)
    {
        $this->options['aspectRatio'] = $ratio;

        return $this;
    }

    protected function type(string $type)
    {
        $this->type = $type;

        return $this;
    }

    protected function hex2rgba($color)
    {
        $hex      = str_replace('#', '', $color);
        $length   = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        $rgb['a'] = self::Opacity;

        return 'rgba('.implode(',', $rgb).')';
    }

    protected function color($index = null)
    {
        $index = $index ?? count($this->data);

        return $this->colors[$index];
    }

    protected function colors()
    {
        if (!$this->colors) {
            $this->colors = array_values(config('enso.charts.colors'));
        }

        return $this->colors;
    }

    protected function ticks()
    {
        $this->options['scales'] = new Obj(['xAxes' => [
            new Obj([
                'ticks' => [
                    'autoSkip' => false,
                    'maxRotation' => 90,
                ],
            ]),
        ]]);
    }
}
