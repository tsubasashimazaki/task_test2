@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2 class="create" style="color:tomato;">Show</h2>
                    {{ $contact->your_name }}
                    {{ $contact->title }}
                    {{ $contact->email }}
                    {{ $contact->url }}
                    {{ $gender }}
                    {{ $age }}
                    {{ $contact->contact }}

                        <form method="GET" action="{{ route('contact.edit', ['id' => $contact -> id])}}">
                        @csrf
                       
                        <input class="btn btn-info" type="submit" value="変更する" >
                        </form>
                        <!-- 最後のidを指定して現在表示しているidを消してもいいかの確認 -->
                        <form method="POST" action="{{ route('contact.destroy', ['id' => $contact -> id])}}" id="delete_{{ $contact->id}}">
                        @csrf
                        <!-- data-idでidを取得 onclickでクリックしたらdeletePost(スレッド全体の削除)実行 -->
                        <a href="#" class="btn btn-danger" data-id="{{ $contact->id}}" onclick="deletePost('this');">削除する</a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
 /***************************** 
削除ボタンを押してすぐにデータ削除されるのも
問題があるので、一旦JavaScroptで
確認メッセージ表示
 ***************************** */ 

function deletePost(e) {
    'use strict';
    if (confirm('本当に削除してもいいですか？')) {
        // 消したいIDを持ってきて実行
        document.getelmentById('delete_' + e.dataset.id).submit();
    }
}
</script>

@endsection
