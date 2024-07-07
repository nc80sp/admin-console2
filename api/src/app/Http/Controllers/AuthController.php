<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $input = $request->all();
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        $success['token'] = $user->createToken($user->name)->plainTextToken;
        $success['id'] = $user->id;
        $success['name'] = $user->name;
        return response()->json($success, 200);
    }

    /**
     * Login api
     *
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $user = Auth::user();
            $user->tokens()->delete();
            $success['token'] = $user->createToken($user->name)->plainTextToken;
            $success['id'] = $user->id;
            $success['name'] = $user->name;

            return response()->json($success, 200);
        } else {
            return response()->json(['error' => 'Unauthorised', 401]);
        }
    }
}
