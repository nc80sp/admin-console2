<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\UserStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stages = Stage::All();

        return response()->json($stages);
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Request $request)
    {
        $userStage = UserStage::where('user_id', '=', $request->user_id)->get();
        return response()->json($userStage);
    }

    /**
     * Display a listing of the resource.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stage_id' => 'required',
            'time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $userStage = UserStage::where('user_id', '=', $request->user()->id)
            ->where('stage_id', '=', $request->stage_id)->get()->first();
        if ($userStage === null) {
            UserStage::create([
                'user_id' => $request->user()->id,
                'stage_id' => $request->stage_id,
                'clear_count' => 1,
                'best_time' => $request->time
            ]);
        } else {
            $userStage->clear_count++;
            $userStage->best_time = ($userStage->best_time < $request->time) ? $userStage->best_time : $request->time;
            $userStage->save();
        }

        return response()->json([]);
    }

}
