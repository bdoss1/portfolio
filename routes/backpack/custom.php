<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    CRUD::resource('comment', 'CommentCrudController');
    CRUD::resource('category', 'CategoryCrudController');
    CRUD::resource('blog', 'BlogCrudController');
    CRUD::resource('portfolio', 'PortfolioCrudController');
}); // this should be the absolute last line of this file
