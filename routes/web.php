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
// contactフォルダのindexにアクセスが来たらContactFormControllerのindexメソッド実行
Route::get('contact/index', 'ContactFormController@index');

// prefixでフォルダ指定 contactが頭につくよ 
// middlewareとauthは認証されたらindexを表示
// Route::groupメソッドの最初の引数は共通の配列で指定
Route::group(['prefix' => 'contact', 'middleware' => 'auth'], function(){
    Route::get('index', 'ContactFormController@index')->name('contact.index'); // ルーティングにはカラム修飾子で名前を付けることができる(基本的には 'フォルダ名.ファイル名')
    Route::get('create', 'ContactFormController@create')->name('contact.create');
    Route::post('store', 'ContactFormController@store')->name('contact.store');
    // ルートパラメーターidの詳細確認
    Route::get('show/{id}', 'ContactFormController@show')->name('contact.show');
    Route::get('edit/{id}', 'ContactFormController@edit')->name('contact.edit');
    Route::post('update/{id}', 'ContactFormController@update')->name('contact.update');
});

Auth::routes(); //認証の機能
// Route::resource('contacts', 'contactFormController')->only([
//     'index', 'show'
// ]);

Route::get('/home', 'HomeController@index')->name('home');
