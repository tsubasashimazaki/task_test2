<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ModelのTestデータを持ってくる為にuse
use App\Models\Test;

class TestController extends Controller
{
    //
    public function index()
    {   
        // データベースからデータを表示させる
        $values = Test::all();

        // この処理で止めて変数の中身を表示
        //dd($values);

        // ビューはresources/viewsディレクトリのサブディレクトリにネスト。
        // ネストしたビューを参照するために「ドット」記法が使える
        return view('tests.test', compact('values'));
    }
}
