<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleToContactFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tableは既存のTBの変更、createはTB新規作成
        Schema::table('contact_forms', function (Blueprint $table) {
            //指定カラムの後にカラム設置 your_nameの後にtitle
            $table->string('title', 50)->after('your_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            //カラムの削除->'title'を消してね
            // migrate:rollbackの時これを記述していないと元に戻れない
            $table->dropColumn('title');
        });
    }
}

/* 
migrate:rollback --step〇〇(◯には数字) 巻き戻す数の限定
rollback stepなどで戻ってしまってももう一度 php artisan migrateすれば
miglationsにファイルが残っているので元どおりになる