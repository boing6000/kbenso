<?php

Route::namespace('LaravelEnso\Core\app\Http\Controllers')
    ->prefix('api')
    ->group(function () {
        Route::get('/getMeta', 'GuestController')
            ->name('getMeta');

        Route::middleware(['web', 'auth', 'core'])
            ->group(function () {
                Route::prefix('core')->as('core.')
                    ->group(function () {
                        Route::get('', 'SpaController')->name('index');

                        Route::prefix('preferences')->as('preferences.')
                            ->group(function () {
                                Route::patch('setPreferences/{route?}', 'PreferencesController@setPreferences')
                                    ->name('setPreferences');
                                Route::post('resetToDefault/{route?}', 'PreferencesController@resetToDefault')
                                    ->name('resetToDefault');
                            });
                    });
            });
    });
