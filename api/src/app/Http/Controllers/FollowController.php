<?php

namespace App\Http\Controllers;

use App\Http\Resources\FollowResource;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FollowController extends Controller
{
    //指定ユーザーIDのフォロー/フォロワーリストを返す
    public function show(Request $request)
    {
        $follows = Follow::where('user_id', '=', $request->user_id)->get();
        $followers = Follow::where('follow_user_id', '=', $request->user_id)->get();
        $response = [
            'follows' => FollowResource::collection($follows),
            'followers' => FollowResource::collection($followers)
        ];
        return response()->json($response, 200);
    }

    //指定ユーザーのフォローを追加
    public function store(Request $request)
    {
        if (Follow::where('user_id', '=', $request->user()->id)
            ->where('follow_user_id', '=', $request->follow_user_id)
            ->exists()) {
            return response()->json(["message" => "already exists"], 400);
        }
        Follow::create([
            'user_id' => $request->user()->id,
            'follow_user_id' => $request->follow_user_id
        ]);
        return response()->json();
    }

    //指定ユーザーのフォローを削除
    public function destroy(Request $request)
    {
        $follow = Follow::where('user_id', $request->user()->id)->where('follow_user_id',
            $request->follow_user_id)->get();
        if ($follow->count() <= 0) {
            return response()->json(['result' => 'ng'], 400);
        }
        $follow->first()->delete();
        return response()->json(['result' => 'ok'], 200);
    }
}
