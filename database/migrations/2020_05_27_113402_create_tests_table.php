<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // upメソッドは新しいテーブルの作成
    public function up()
    {
        /*
         Schemaファサードのcreateメソッド
         引数1, 2にテーブル名とクロージャ 
         これはphp artisan make:migratiion create_tests_tableで作成されたもの
        */
        /* 
        Blueprintオブジェクトのメソッドでカラムの指定
        */
        Schema::create('tests', function (Blueprint $table) {
            // カラムの型名がそのままメソッドになっている
            $table->bigIncrements('id');
            $table->string("text", 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // upメソッドが行った操作を元に戻す
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
