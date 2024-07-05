@extends('layouts.app')
@php($mailList = true)
@section('content')
    <div class="bg-warning-subtle rounded">
        <h3 class="display-10">メール一覧</h3>
    </div>

    {{$mails->links()}}
    <table class="justify-content-start table table-bordered  p-2 overflow-auto">
        <tr>
            <th>ID</th>
            <th>タイトル</th>
            <th>メッセージ</th>
            <th>送付アイテム名</th>
            <th>送付個数</th>
        </tr>

        @foreach($mails as $mail)
            <tr>
                <td>{{$mail->id}}</td>
                <td>{{$mail->title}}</td>
                <td>{{$mail->body}}</td>
                <td>
                    @if ($mail->item != null)
                        {{$mail->item->name}}
                    @endif
                </td>
                <td>{{$mail->amount}}</td>
            </tr>
        @endforeach
    </table>
@endsection
