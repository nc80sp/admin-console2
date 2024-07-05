@extends('layouts.app')
@php($haveMailList = true)
@section('content')
    <div class="bg-warning-subtle rounded">
        <h3 class="display-10">ユーザー受信メール一覧</h3>
    </div>

    <div>
        <form method="get" action="{{route('users.showMail')}}">
            <input type="text" name="id" placeholder="ユーザーIDを入力">
            <input type="submit" value="検索">
        </form>
    </div>

    @if (isset($mails))
        {{$mails->onEachSide(1)->links()}}
        <table class="justify-content-start table table-bordered  p-2 overflow-auto">
            <tr>
                <th>ユーザー名</th>
                <th>受信メールタイトル</th>
                <th>開封したかどうか</th>
            </tr>

            @foreach($mails as $mail)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$mail->title}}</td>
                    <td>{{$mail->pivot->received}}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
