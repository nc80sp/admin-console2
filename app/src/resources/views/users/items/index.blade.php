@extends('layouts.app')
@php($haveItemList = true)
@section('content')
    <div class="bg-warning-subtle rounded">
        <h3 class="display-10">ユーザー所持アイテム一覧</h3>
    </div>

    <div>
        <form method="get" action="{{route('users.showItem')}}">
            <input type="text" name="id" placeholder="ユーザーIDを入力">
            <input type="submit" value="検索">
        </form>
    </div>

    @if (isset($items))
        {{$items->onEachSide(1)->links()}}
        <table class="justify-content-start table table-bordered  p-2 overflow-auto">
            <tr>
                <th>ユーザー名</th>
                <th>アイテム名</th>
                <th>所持個数</th>
            </tr>


            @foreach($items as $item)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->pivot->amount}}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
