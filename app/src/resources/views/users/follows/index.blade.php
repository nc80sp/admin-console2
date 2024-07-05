@extends('layouts.app')
@php($haveFollowList = true)
@section('content')
    <div class="bg-warning-subtle rounded">
        <h3 class="display-10">ユーザーフォロー一覧</h3>
    </div>

    <div>
        <form method="get" action="{{route('users.showFollow')}}">
            <input type="text" name="id" placeholder="ユーザーIDを入力">
            <input type="submit" value="検索">
        </form>
    </div>

    @if (isset($follows))
        {{$follows->onEachSide(3)->links()}}
        <table class="justify-content-start table table-bordered  p-2 overflow-auto">
            <tr>
                <th>ユーザー名</th>
                <th>フォローユーザー名</th>
            </tr>

            @foreach($follows as $follow)
                <tr>
                    <td>{{$follow->user->name}}</td>
                    <td>{{$follow->followUser->name}}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
