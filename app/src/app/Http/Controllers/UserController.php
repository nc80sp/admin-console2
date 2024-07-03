<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\UserItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // ログインしているかチェック
        if (!$request->session()->exists('login')) {
            // ログイン画面にリダイレクト
            return redirect('/');
        }

        if (empty($request->name)) {
            $users = User::paginate(10);
        } else {
            $users = User::where('name', '=', $request->name)->paginate(10);
        }

        return view('users.index', ['users' => $users]);
    }

    public function showItem(Request $request)
    {
        //個別指定
        $user = User::find($request->id);
        if (!empty($user)) {
            $items = $user->items()->paginate(10);
            $items->appends(['id' => $request->id]);
        }
        return view('users.items.index', ['user' => $user, 'items' => $items ?? null]);
    }
}
