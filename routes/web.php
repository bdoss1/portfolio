<?php

Route::get('/', 'HomeController@index')->name('index');
Route::get('/about', 'PageController@about')->name('about');
Route::get('/blog', function() {})->name('blog.index');
Route::get('/contact', 'PageController@contact')->name('contact');

// Auth::routes(); disabled, because i use only 3 routes [login(get|post), logout(post)] for my Portfolio

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('portfolio', 'PortfolioController@index')->name('portfolio.index');
Route::get('portfolio/item/{slug}', 'PortfolioController@show')->name('portfolio.show');
Route::post('portfolio/load', 'PortfolioController@load')->name('portfolio.load');
Route::get('portfolio/{slug}', 'Category\PortfolioController@show')->name('portfolio.category.show');
Route::post('portfolio/load/{slug}', 'Category\PortfolioController@load')->name('portfolio.category.load');

Route::get('blog', 'BlogController@index')->name('blog.index');
Route::get('blog/item/{slug}', 'BlogController@show')->name('blog.show');
Route::post('blog/load', 'BlogController@load')->name('blog.load');
Route::get('blog/{slug}', 'Category\BlogController@show')->name('blog.category.show');
Route::post('blog/load/{slug}', 'Category\BlogController@load')->name('blog.category.load');

Route::post('form/contact', 'FormController@contact')->name('form.contact');