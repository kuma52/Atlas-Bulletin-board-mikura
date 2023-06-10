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

// ログアウト中のページ -------------------------------
Route::get('/login', 'Auth\Login\LoginController@login')->name('login');
// Route::post('/login', 'Auth\Login\LoginController@login');

Route::get('/register', 'Auth\Register\RegisterAddedController@register');
Route::post('/register', 'Auth\Register\RegisterAddedController@createnewuser');

// ログイン中のページ -------------------------------
