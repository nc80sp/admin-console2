<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserItemResource;
use App\Http\Resources\UserMailResource;
use App\Http\Resources\UserResource;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'min_level' => ['required', 'int'],
            'max_level' => ['required', 'int'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
//        $users = User::Where('id', '=', 58)->first();
//        $users->tokens()->delete();
        $users = User::where('level', '>=', $request->min_level)->where('level', '<',
            $request->max_level)->get();

        return response()->json(UserResource::collection($users));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        Log::error('aa');
        $user = Cache::get('user_show_' . $request->user_id, function () use ($request) {
            $data = User::findOrFail($request->user_id);
            Cache::set('user_show_' . $request->user_id, $data);
            return $data;
        });
        //$user = User::findOrFail($request->user_id);
        $response = [
            'detail' => UserResource::make($user),
        ];

        if (isset($request->withItems) && $request->withItems === "true") {
            $response['items'] = UserItemResource::collection($user->items);
        }
        if (isset($request->withMails) && $request->withMails === "true") {
            $response['mails'] = UserMailResource::collection($user->mails);
        }
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $user = DB::transaction(function () use ($request) {
                $user = $request->user();
                if (isset($request->name)) {
                    $user->name = $request->name;
                }
                if (isset($request->level)) {
                    $user->level = $request->level;
                }
                if (isset($request->exp)) {
                    $user->exp = $request->exp;
                }
                if (isset($request->life)) {
                    $user->life = $request->life;
                }
                $user->save();

                clock($user);
                return $user;
            });
            return response()->json(new UserResource($user), 200);
        } catch (Exception $e) {
            return response()->json($e, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
