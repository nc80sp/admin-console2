<?php
//-------------------------------------------------
// アカウントコントローラー [AccountController.php]
// Author:Kenta Nakamoto
// Data:2024/06/11
//-------------------------------------------------

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    // アカウント一覧を表示する
    public function index(Request $request)
    {
        // ログインしているかチェック
        if (!$request->session()->exists('login')) {
            // ログイン画面にリダイレクト
            return redirect('accounts/index');
        }

        if (empty($request->name)) {
            $accounts = Account::All();
        } else {
            $accounts = Account::where('name', '=', $request->name)->get();
        }

        return view('accounts.index', ['accounts' => $accounts]);
    }

    //アカウント登録画面表示
    public function create(Request $request)
    {
        return view('accounts.create');
    }

    //アカウント登録
    public function store(Request $request)
    {
        //バリデーションチェック
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:20'],
            'password' => ['required', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()->route('accounts.create', ['name' => $request->name])
                ->withErrors($validator)
                ->withInput();
        }

        $account = Account::where('name', '=', $request->password)->get();
        if ($account->count() > 0) {
            return redirect()->route('accounts.create', ['error' => 'already', 'name' => $request->name]);
        }

        Account::create([
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('accounts.create', ['account' => $request->name]);
    }

    //アカウント削除確認画面表示
    public function delete(Request $request)
    {
        if (isset($request->id)) {
            $account = Account::findOrFail($request->id);
        } else {
            $account = null;
        }

        return view('accounts.delete', ['account' => $account]);
    }

    //アカウント削除処理
    public function destroy(Request $request)
    {
        $account = Account::findOrFail($request->id);
        $name = $account->name;
        $account->delete();

        return redirect()->route('accounts.delete', ['name' => $name]);
    }

    //アカウント更新画面表示
    public function edit(Request $request)
    {
        if (isset($request->id)) {
            $account = Account::findOrFail($request->id);
        } else {
            $account = null;
        }

        return view('accounts.edit', ['account' => $account]);
    }

    //アカウント更新処理
    public function update(Request $request)
    {
        $account = Account::findOrFail($request->id);
        $name = $account->name;
        $account->password = Hash::make($request->password);
        $account->save();

        return redirect()->route('accounts.edit', ['name' => $name]);
    }
}
