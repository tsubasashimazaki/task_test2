<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// クラス名ありファイル
use App\Models\ContactForm;
// クエリビルダ DBのファサードを使える
use Illuminate\Support\Facades\DB;


class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $contact = ContactForm::all();
        // 最終的な結果をget()で取得する
        $contacts = DB::table('contact_forms')
        ->select('id', 'your_name', 'title', 'created_at')
        ->orderBy('created_at', 'desc') //テーブルの列の順番を変える
        ->get();
        // dd($contacts);
        // indexページを返す
        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //新規作成の場合はページだけ返してあげればOK
        return view('contact.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  リクエストクラス、依存性の注入 一般的なPHP$_POST['your_name']等
    public function store(Request $request)
    {   

        $contact = new ContactForm;

        // $requestに登録してある 'your_name' が持ってこれる
        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        // dd($your_name);

        $contact->save();

        return redirect('contact/index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 一人ずつを出すのでエロクゥアント 
       $contact = ContactForm::find($id); //contactはcreateで入力さされた値
        // showにgenderやageがvalueの数字で出されてしまうのでif文で数字から文字列に変更
       if($contact->gender === 0){
           $gender = '男性';
       }
       if($contact->gender === 1){
           $gender = '女性';
       }

       if($contact->age === 1){
           $age = '〜19歳';
       }
       if($contact->age === 2){
           $age = '20〜29歳';
       }
       if($contact->age === 3){
           $age = '30〜39歳';
       }
       if($contact->age === 4){
           $age = '40〜49歳';
       }
       if($contact->age === 5){
           $age = '50〜59歳';
       }
       if($contact->age === 6){
           $age = '60歳〜';
       }

       return view('contact.show',
       compact('contact','gender','age')); //変数名(複数可能)とその値から配列を返す 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
