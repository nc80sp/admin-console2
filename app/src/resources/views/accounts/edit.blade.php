@extends('layouts.app')
@php($accountAdd = true)
@section('content')
    <div class="bg-warning-subtle rounded">
        <h3 class="display-10">管理者パスワード更新</h3>
    </div>

    <main class="form-signin w-100 m-auto">
        <div class="d-flex align-items-center py-4 bg-body-tertiary">

            @if (!empty(request()->get('name')))
                <div class="text-primary">
                    [{{request()->get('name')}}] のパスワード更新が完了しました。
                </div>
            @else
            <form method="post" action="{{route('accounts.update')}}">
                @csrf
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="name"
                        value="{{$account->name}}"
                        disabled
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
                <input type="hidden" name="id" value="{{$account->id}}">
                <button class="btn btn-primary w-100 py-2" type="submit">更新</button>
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
            @endif
        </div>
    </main>
@endsection
