<?php

namespace App\Http\Controllers;

use App\Http\Resources\MailResource;
use App\Models\Mail;
use App\Models\UserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function index()
    {
        $mails = Mail::All();
        return response()->json(MailResource::collection($mails->keyBy->id), 200);
    }

    public function update(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $mail = UserMail::where('user_id', $request->user()->id)->where('mail_id',
                $request->mail_id)->get();
            if ($mail->count() <= 0) {
                return response()->json(['result' => 'ng'], 400);
            }
            $old = $mail->first()->received;
            $mail->first()->received = $request->received;
            $mail->first()->save();
            if ($old === 0 && $mail->first()->received === 1) {
                //アイテムも追加
                $itemController = app()->make(ItemController::class);

                $mail = Mail::find($request->mail_id);

                $request->merge(['item_id' => $mail->item_id, 'amount' => $mail->amount]);
                $itemController->store($request);
            }

            return response()->json(['result' => 'ok'], 200);
        });
    }
}
