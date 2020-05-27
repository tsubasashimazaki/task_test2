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
        // collectでグループ分け
        $collection = collect([1, 2, 3, 4, 5, 6, 7]);
        // 一つのグループに4つ入れてね
        $chunks = $collection->chunk(4);
        // コレクションをPHPの配列に変換
        $chunks->toArray();

        // この処理で止めて変数の中身を表示
        dd($chunks);

        // ビューはresources/viewsディレクトリのサブディレクトリにネスト。
        // ネストしたビューを参照するために「ドット」記法が使える
        return view('tests.test', compact('values'));
    }
}
