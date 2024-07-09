<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\UserItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::All();
        return response()->json(ItemResource::collection($items->keyBy->id), 200);
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
