@extends('layouts.app')
@php($mailAdd = true)
@section('content')
    <div class="bg-warning-subtle rounded">
        <h3 class="display-10">メール送信</h3>
    </div>

    <main class="form-signin w-100 m-auto">
        <div class="d-flex align-items-center py-4 bg-body-tertiary">
            <form method="post" action="{{route('mails.store')}}">
                @csrf
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="user_id"
                           @if(!empty(request()->get('user_id')))
                               value="{{request()->get('user_id')}}"
                        @endif
                    >
                    <label for="floatingInput">ユーザーID</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="mail_id"
                           @if(!empty(request()->get('mail_id')))
                               value="{{request()->get('mail_id')}}"
                        @endif
                    >
                    <label for="floatingInput">メールID</label>
                </div>
                <br>
                <button class="btn btn-primary w-100 py-2" type="submit">送信</button>
            </form>
            <div class="text-danger">
                <ul>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            @if (!empty(request()->get('result')))
                <div class="text-primary">
                    メール送信が完了しました。
                </div>
            @endif
        </div>
    </main>
@endsection
