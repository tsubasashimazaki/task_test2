@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- laravelの場合Route表記が可能 -->
                    <form method="GET" action="{{ route('contact.create')}}">
                    <button type="submit" class="btn btn-primary">新規登録</button>
                    </form>
                    
                    <table class="table text-center">
                        <thead>
                            <tr>
                            <th scope="col">id</th>
                            <th scope="col">氏名</th>
                            <th scope="col">件名</th>
                            <th scope="col">登録日時</th>
                            <th scope="col">詳細</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                            <th>{{ $contact->id}}</th>
                            <td>{{ $contact->your_name}}</td>
                            <td>{{ $contact->title}}</td>
                            <td>{{ $contact->created_at}}</td>
                            <!-- route関数の第二引数にパラメータ -->
                            <td><a href="{{ route('contact.show' , ['id' => $contact->id])}}">詳細を見る</a><td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
