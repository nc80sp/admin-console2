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
            $itemDatas = Item::paginate(10);
        } else {
            $itemDatas = Item::where('name', '=', $request->name)->paginate(10);
        }

        return view('items.index', ['itemDatas' => $itemDatas]);
    }
}
