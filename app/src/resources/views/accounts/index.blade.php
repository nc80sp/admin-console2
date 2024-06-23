@extends('layouts.app')
@php($accountList = true)
@section('content')
    <div class="bg-warning-subtle rounded">
        <h3 class="display-10">管理者一覧</h3>
    </div>

    <div>
        <form method="get" action="{{route('accounts.index')}}">
            <input type="text" name="name" placeholder="名前を入力">
            <input type="submit" value="検索">
        </form>
    </div>

    <table class="justify-content-start table table-bordered  p-2 overflow-auto">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>パスワード</th>
            <th>生成日時</th>
            <th>更新日時</th>
            <th>操作</th>
        </tr>

        @foreach($accounts as $account)
            <tr>
                <td>{{$account['id']}}</td>
                <td>{{$account['name']}}</td>
                <td>{{$account['password']}}</td>
                <td>{{$account['created_at']}}</td>
                <td>{{$account['updated_at']}}</td>
                <td>
                    <form method="post" action="{{route('accounts.delete')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$account['id']}}">
                        <input type="submit" value="削除">
                    </form>
                    <form method="post" action="{{route('accounts.edit')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$account['id']}}">
                        <input type="submit" value="変更">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
