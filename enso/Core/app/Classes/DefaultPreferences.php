<?php

namespace LaravelEnso\Core\app\Classes;

class DefaultPreferences
{
    public $data;

    public function __construct()
    {
        $this->data = $this->readDefault();
    }

    public function data()
    {
        return json_decode($this->data);
    }

    private function readDefault()
    {
        return \File::get(resource_path('preferences.json'));
    }
}
