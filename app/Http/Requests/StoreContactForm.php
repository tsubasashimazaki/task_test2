<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() //authorizeで認証しているかどうか
    {
        // デフォルトはfalseaだとうまく動かない trueにすること
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //バリデーションルール記述
            // この | 棒でバリデーション追加できる create.phpのinputのname
            'your_name' => 'required|string|max:20', //required = 必須
            'title' => 'required|string|max:50',
            'email' => 'required|email|unique:contact_forms|max:255', //メールアドレスがたくさん登録できないように unique:テーブル名
            'url' => 'url|nullable',
            'gender' => 'required',
            'age' => 'required',
            'contact' => 'required|string|max:200',
            'caution' => 'required|accepted', //accepted = チェックしているか
        ];
    }
}
