@extends('layouts.app')
@php($userList = true)
@section('content')
    <div class="bg-warning-subtle rounded">
        <h3 class="display-10">ユーザー一覧</h3>
    </div>

    <div>
        <form method="get" action="{{route('users.index')}}">
            <input type="text" name="name" placeholder="名前を入力">
            <input type="submit" value="検索">
        </form>
    </div>

    <table class="justify-content-start table table-bordered  p-2 overflow-auto">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>レベル</th>
            <th>経験値</th>
            <th>ライフ</th>
            <th>生成日時</th>
            <th>更新日時</th>
        </tr>

        @foreach($users as $user)
            <tr>
                <td>{{$user['id']}}</td>
                <td>{{$user['name']}}</td>
                <td>{{$user['level']}}</td>
                <td>{{$user['exp']}}</td>
                <td>{{$user['life']}}</td>
                <td>{{$user['created_at']}}</td>
                <td>{{$user['updated_at']}}</td>
            </tr>
        @endforeach
    </table>
@endsection
