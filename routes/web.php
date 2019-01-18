<?php

Route::get('/', 'HomeController@index')->name('index');
Route::get('/about', function() {})->name('about');
Route::get('/blog', function() {})->name('blog.index');
Route::get('/contact', function() {})->name('contact');

// Auth::routes(); disabled, because i use only 3 routes [login(get|post), logout(post)] for my Portfolio

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('portfolio', 'PortfolioController@index')->name('portfolio.index');
Route::get('portfolio/item/{slug}', 'PortfolioController@show')->name('portfolio.show');
Route::post('portfolio/load', 'PortfolioController@load')->name('portfolio.load');
Route::get('portfolio/{slug}', 'Category\PortfolioController@show')->name('portfolio.category.show');
Route::post('portfolio/load/{slug}', 'Category\PortfolioController@load')->name('portfolio.category.load');