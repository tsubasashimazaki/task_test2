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

// このアドレスにアクセスしたら'welcome'にページに飛ばす
// 念の為ここのgetはhttpを受け取ったらという意味
Route::get('/', function () {
    return view('welcome');
});

// コントローラーで違う場所に飛ばす処理
// testにアクセしたらTestControllerのindexメソッドを呼びだせ
Route::get('tests/test', 'TestController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
