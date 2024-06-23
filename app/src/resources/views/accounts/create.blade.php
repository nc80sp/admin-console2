@extends('layouts.app')
@php($accountAdd = true)
@section('content')
    <div class="bg-warning-subtle rounded">
        <h3 class="display-10">管理者登録</h3>
    </div>

    <main class="form-signin w-100 m-auto">
    <div class="d-flex align-items-center py-4 bg-body-tertiary">
        <form method="post" action="{{route('accounts.store')}}">
            @csrf
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" name="name"
                @if(!empty(request()->get('name')))
                    value="{{request()->get('name')}}"
                    @endif
                >
                <label for="floatingInput">アカウント名</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password">
                <label for="floatingPassword">パスワード</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword_confirmation" name="password_confirmation">
                <label for="floatingPassword_confirmation">パスワード再入力</label>
            </div>
            <br>
            <button class="btn btn-primary w-100 py-2" type="submit">登録</button>
        </form>
        <div class="text-danger">
            <ul>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                @endif
                @if (request()->get('error') === 'already')
                    <li>既に登録済みのユーザーです</li>
                @endif
            </ul>
        </div>
        @if (!empty(request()->get('account')))
            <div class="text-primary">
                [{{request()->get('account')}}] のアカウント登録が完了しました。
            </div>
        @endif
    </div>
    </main>
@endsection
