<?php
/**
 * Created by PhpStorm.
 * User: boing
 * Date: 09/01/2019
 * Time: 15:32
 */

Route::get('pdf', function () {
    return view('report-generator-view::viewer');
})->name('pdf.viewer');