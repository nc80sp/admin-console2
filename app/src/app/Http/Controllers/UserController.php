<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\UserItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
            $users = Cache::get('user_show_' . $request->name, function () use ($request) {
                $users = User::where('name', '=', $request->name)->paginate(10);
                Cache::set('user_show_' . $request->name, $users);
                return $users;
            });
//            $users = User::where('name', '=', $request->name)->paginate(10);
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

    public function showFollow(Request $request)
    {
        $user = User::find($request->id);
        if (!empty($user)) {
            $follows = $user->follows()->paginate(10);
            $follows->appends(['id' => $request->id]);
        }
        return view('users.follows.index', ['user' => $user, 'follows' => $follows ?? null]);
    }

    public function showMail(Request $request)
    {
        $user = User::find($request->id);
        if (!empty($user)) {
            $mails = $user->mails()->paginate(10);
            $mails->appends(['id' => $request->id]);
        }
        return view('users.mails.index', ['user' => $user, 'mails' => $mails ?? null]);
    }
}
