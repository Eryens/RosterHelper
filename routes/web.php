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
    return view('index');
});

Auth::routes();

Route::get('/class', 'PlayerClassController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['permission:admin access']], function () {
    // Raid
    Route::resource('raid', 'RaidController');

    // Boss
    Route::resource('boss', 'BossController');

    // Users
    Route::get('user', 'UserController@index')->name('user.index');
    Route::get('user/list/{raid}', 'UserController@list')->name('user.list');
    Route::post('user/confirm/', 'UserController@confirm')->name('user.confirm');
    Route::put('user/{id}', 'UserController@update')->name('user.update');
});
    
