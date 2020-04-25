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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('user/profile', 'UserProfileController');

Route::get('user/profile', 'UserProfileController@index');
Route::get('user/profile/create', 'UserProfileController@create');
Route::get('user/profile/{id}/show', 'UserProfileController@index');
Route::put('user/profile/{id}', 'UserProfileController@update');
Route::get('user/profile/{id}/edit', 'UserProfileController@edit');
Route::delete('user/profile/{id}', 'UserProfileController@destroy');
