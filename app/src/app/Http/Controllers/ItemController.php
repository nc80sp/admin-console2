<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // ログインしているかチェック
        if (!$request->session()->exists('login')) {
            // ログイン画面にリダイレクト
            return redirect('/');
        }

        if (empty($request->name)) {
            $itemDatas = Item::All();
        } else {
            $itemDatas = Item::where('name', '=', $request->name)->get();
        }

        return view('items.index', ['itemDatas' => $itemDatas]);
    }
}
