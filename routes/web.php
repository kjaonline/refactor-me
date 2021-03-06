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

Route::get('/', 'PublicController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('user/profile', 'UserProfileController');

Route::post('user/profile', 'UserProfileController@store');
Route::get('user/profile/create', 'UserProfileController@create');
Route::get('user/profile/{id}/show', 'UserProfileController@show')->name('profile_home');
Route::put('user/profile/{id}', 'UserProfileController@update');
Route::get('user/profile/{id}/edit', 'UserProfileController@edit');
Route::delete('user/profile/{id}', 'UserProfileController@destroy');
