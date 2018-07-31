<?php
/**
 * Created by PhpStorm.
 * User: boing
 * Date: 31/07/2018
 * Time: 08:49
 */

namespace LaravelEnso\FormBuilder\app\Classes;


class KBuilder extends Builder
{
    private $template;
    private $model;

    private function setValues(){
        if (!$this->model) {
            return $this;
        }

        collect($this->template->sections)->each(function ($section) {
            collect($section->fields)->each(function ($field) {
                dd($field);
                $field->value = $this->model->{$field->name};
            });
        });

        return $this;
    }
}