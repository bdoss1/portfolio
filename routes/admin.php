<?php

Route::group([
    'prefix' => config('admin.panel_prefix'),
    'as' => 'admin.'
], function() {
    Route::get('/', 'Admin\HomeController@index')->name('index');
});




