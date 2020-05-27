<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // upメソッドはデータベースに追加する
    public function up()
    {
        // terminalではContactFormで単数形だが、DBが大小文字判断できない為スネークケーズ表現
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            // 氏名、メールアドレス、url、性別、年齢、お問い合わせ内容
            $table->string('your_name', 20); //文字長を指定VARCHAR(文字列)
            $table->string('email', 255);
            $table->longText('url')->nullable($value = true);
            $table->boolean('gender'); //性別は0 or 1 なので
            $table->tinyInteger('age'); //tinyInt 符号無しの整数型
            $table->string('contact', 200); //文字長を指定VARCHAR(文字列)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // downメソッドはupメソッドが行った操作を元に戻す
    public function down()
    {
        Schema::dropIfExists('contact_forms');
    }
}
