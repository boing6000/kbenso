<?php

namespace LaravelEnso\VueDatatable\app\Traits;

use Illuminate\Http\Request;

/**
 * Trait Datatable
 * @package LaravelEnso\VueDatatable\app\Traits
 * @property \LaravelEnso\VueDatatable\app\Classes\Table $tableClass
 */
trait Datatable
{
    public function init()
    {
        return (new $this->tableClass())
            ->init();
    }

    public function data(Request $request)
    {
        $table = new $this->tableClass($request->all());
        return $table->data();
    }
}
