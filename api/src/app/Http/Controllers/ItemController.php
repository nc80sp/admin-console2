<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\User;
use App\Models\UserItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Cache::get('items', function () use ($request) {
            $items = Item::All();
            Cache::set('items', $items);
            return $items;
        });
        return response()->json($items->keyBy->id, 200);
    }

    public function store(Request $request)
    {
        $item = UserItem::where('user_id', $request->user()->id)->where('item_id',
            $request->item_id)->get();
        if ($item->count() <= 0) {
            UserItem::create([
                'user_id' => $request->user()->id,
                'item_id' => $request['item_id'],
                'amount' => $request['amount']
            ]);
        } else {
            $item->first()->amount = $item->first()->amount + $request->amount;
            $item->first()->save();
        }
        return response()->json(['result' => 'ok'], 200);
    }
}
