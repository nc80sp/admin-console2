@extends('layouts.app')
@php($itemList = true)
@section('content')
    <div class="bg-warning-subtle rounded">
        <h3 class="display-10">アイテム一覧</h3>
    </div>

    <div>
        <form method="get" action="{{route('items.index')}}">
            <input type="text" name="name" placeholder="名前を入力">
            <input type="submit" value="検索">
        </form>
    </div>

    {{$itemDatas->links()}}
    <table class="justify-content-start table table-bordered  p-2 overflow-auto">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>種別</th>
            <th>効果値</th>
            <th>説明</th>
        </tr>

        @foreach($itemDatas as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['type']}}</td>
                <td>{{$item['value']}}</td>
                <td>{{$item['desc']}}</td>
            </tr>
        @endforeach
    </table>
@endsection
