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
            $users = User::All();
        } else {
            $users = User::where('name', '=', $request->name)->get();
        }

        return view('users.index', ['users' => $users]);
    }

    public function showItem(Request $request)
    {
        if (!empty($request->name)) {
            $user = User::where('name', '=', $request->name)->get()->first();
            /*            $haveItems = UserItem::select([
                'user_items.id as id',
                'users.name as user_name',
                'items.name as item_name',
                'amount'
            ])
                ->join('users', 'users.id', '=', 'user_items.user_id')
                ->join('items', 'items.id', '=', 'user_items.item_id')
                ->where('users.name', '=', $request->name)
                ->get();*/
            return view('users.items.show', ['user' => User::find($user->id)]);
        } else {
            $user = User::All();
            $haveItems = UserItem::select([
                'user_items.id as id',
                'users.name as user_name',
                'items.name as item_name',
                'amount'
            ])
                ->join('users', 'users.id', '=', 'user_items.user_id')
                ->join('items', 'items.id', '=', 'user_items.item_id')
                ->get();
            return view('users.items.index', ['users' => $user]);
        }
    }
}
