<?php

Route::get('/', 'HomeController@index')->name('index');

// Auth::routes(); disabled, because i use only 3 routes [login(get|post), logout(post)] for my Portfolio

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('portfolio', 'PortfolioController@index')->name('portfolio.index');
Route::get('portfolio/{item}', 'PortfolioController@show')->name('portfolio.show');
Route::post('portfolio/load/{page}', 'PortfolioController@load')->name('portfolio.load');