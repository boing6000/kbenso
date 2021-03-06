<?php

namespace LaravelEnso\MenuManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use LaravelEnso\MenuManager\app\Tables\Builders\MenuTable;

class MenuTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = MenuTable::class;
}
