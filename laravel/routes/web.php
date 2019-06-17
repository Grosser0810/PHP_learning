<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/post/{slug}','HomeController@show')->name('post.show');
Route::get('/registration', 'AurhController@registerForm');
Route::post('registration', 'AurhController@register');
Route::get('/login', 'AurhController@loginForm');
Route::post('/login','AurhController@login');
Route::get('/logout', 'AurhController@logout');
Route::get('about','AurhController@showAbout');

Route::get('/admin','Admin\DashboardController@index');
Route::resource('/admin/categories','Admin\CategoriesController');
Route::resource('/admin/tags','Admin\TagsController');
Route::resource('admin/users', 'Admin\UsersController');
Route::resource('admin/posts', 'Admin\PostsController');