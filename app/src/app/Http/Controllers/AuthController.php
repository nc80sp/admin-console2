<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        //バリデーションチェック
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:20'],
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.index')
                ->withErrors($validator)
                ->withInput();
        }

        //db取得
        $accounts = Account::where('name', '=', $request->name)->get();

        //カラム数チェック
        if ($accounts->count() <= 0) {
            return redirect()->route('auth.index', ['error' => 'invalid']);
        }

        //パスワードハッシュチェック
        if (Hash::check($request->password, $accounts[0]->password)) {
            $request->session()->put('login', true);
            return redirect()->route('accounts.index');
        } else {
            return redirect()->route('auth.index', ['error' => 'invalid']);
        }
    }

    public function logout(Request $request)
    {
        // セッション解放後にログイン画面へ
        $request->session()->forget('login');
        return redirect()->route('auth.index');
    }
}
