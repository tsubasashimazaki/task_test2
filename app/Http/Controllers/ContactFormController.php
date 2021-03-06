<?php
// ContactFotmControllerはこのフォルダにある この名前空間にある関数だよ namespaceは各ファイルに一つが基本
namespace App\Http\Controllers; 

use Illuminate\Http\Request; //useには名前空間のインポートや、エイリアス作成時使用

use App\Models\ContactForm;
use Illuminate\Support\Facades\DB; // クエリビルダ DBのファサードを使える(->SQLの記述の矢印)
use App\Services\CheckFormData; //CheckFormDataを使うため記述
use App\Http\Requests\StoreContactForm; //バリデーションファイル読み込み


class ContactFormController extends Controller //クラスはファイル名と同じにする必要がある
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // リクエストクラスのインスタンスでデータを持ってくる
    public function index(Request $request)
    {   
        $search = $request->input('search');// indexの検索欄のsearchで入ってきたものを$search変数に入れる



        // $contact = ContactForm::all();
        // 最終的な結果をget()で取得する
        // $contacts = DB::table('contact_forms')
        // ->select('id', 'your_name', 'title', 'created_at')
        // ->orderBy('created_at', 'desc') //テーブルの列の順番を変える
        // ->paginate(20);

        //検索フォーム
        $query = DB::table('contact_forms');
        // $searchがnull='空白'じゃなかったらif文
        // 空白であれば通常のpagination
        if($search !== null){
            // 全角スペースを半角に変更する記述
            $search_split = mb_convert_kana($search, 's');

            $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY); //PREG_SPLIT_NO_EMPTY=空文字でないものが変数に渡される

            //単語をループで回す
            foreach($search_split2 as $value)
            {
                $query->where('your_name', 'like', '%'.$value.'%');
            }
        }


        $query->select('id', 'your_name', 'title', 'created_at');
        $query->orderBy('created_at', 'asc');
        $contacts = $query->paginate(20);

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
    // 引数のStoreContactFormはcreateのinputが送信されて保存される前にバリデーションをかけるためここに記述
    public function store(StoreContactForm $request)
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
        // ファットコントローラ => 一つのコントローラーの処理が大きくなってしまうこと
        //スリムにする必要がある
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
       
        $gender = CheckFormData::checkGender($contact); // staticで指定しているので::でメソッドが使える
        $age = CheckFormData::checkAge($contact); 

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
        
        $contact = ContactForm::find($id);

        

        return view('contact.edit', compact('contact'));
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
        $contact = ContactForm::find($id); //今すでに存在している値

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    
    {
        $contact = ContactForm::find($id); //今すでに存在している値
        $contact->delete(); //データの消し方 deleteメソッド

        return redirect('contact/index');//データベースの更新とデータベースの中を消すのでredirect()


    }
}
