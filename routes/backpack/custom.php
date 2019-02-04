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
    Route::post('comments/approve', 'CommentCrudController@approve')->name('admin.comment.approve');
    Route::post('comments/un-approve', 'CommentCrudController@unApprove')->name('admin.comment.un_approve');

    CRUD::resource('category', 'CategoryCrudController');
    CRUD::resource('blog', 'BlogCrudController');
    CRUD::resource('portfolio', 'PortfolioCrudController');
    CRUD::resource('form', 'FormCrudController');
    CRUD::resource('review', 'ReviewCrudController');
}); // this should be the absolute last line of this file
