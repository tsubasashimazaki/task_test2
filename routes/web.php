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
Route::get('/', function () {
    return view('welcome');
});
