<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

/************************************************
 factory生成時はApp\Modelになってしまっている
 今回はContactFormのモデルデータを使用したいので
 use App\Models\ContactFormと書き換えること
  また、define(***::)の箇所もモデル名と統一させる
 ************************************************/
use App\Models\ContactForm;
use Faker\Generator as Faker;

$factory->define(ContactForm::class, function (Faker $faker) {
    return [
        //この中にfakerでデータを入れていく
        // 左側はデータベースの列（以前登録したもの）
        'your_name' => $faker->name,
        'title' => $faker->realText(50), //文字列はrealTextしか使えない
        'email' => $faker->unique()->email,
        'url' => $faker->url,
        'gender' => $faker->randomElement(['0', '1']),
        'age' => $faker->numberBetween($min = 1, $max = 6),
        'contact' => $faker->realText(200),

    ];
});
