<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ModelのTestデータを持ってくる為にuse
use App\Models\Test;
// クエリビルダ
use Illuminate\Support\Facades\DB;


class TestController extends Controller
{
    //
    public function index()
    {   
        // データベースからデータを表示させる
        $values = Test::all();
        // DBファザードのtableメソッド
        $tests = DB::table('tests')->select('id')->get();
        // この処理で止めて変数の中身を表示
        dd($tests);

        // ビューはresources/viewsディレクトリのサブディレクトリにネスト。
        // ネストしたビューを参照するために「ドット」記法が使える
        return view('tests.test', compact('values'));
    }
}
