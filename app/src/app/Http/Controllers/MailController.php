<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\UserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function index(Request $request)
    {
        $mails = Mail::paginate(10);

        return view('mails.index', ['mails' => $mails]);
    }

    public function create(Request $request)
    {
        return view('mails.create');
    }

    public function store(Request $request)
    {
        //バリデーションチェック
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'mail_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('mails.create')
                ->withErrors($validator)
                ->withInput();
        }

        UserMail::create([
            'user_id' => $request->user_id,
            'mail_id' => $request->mail_id,
            'received' => false
        ]);

        return redirect()->route('mails.create', ['result' => 'success']);
    }
    /*

        public function show(Mail $mail)
        {
            return $mail;
        }

        public function update(Request $request, Mail $mail)
        {
            $data = $request->validate([
                'title' => ['required'],
                'body' => ['required'],
                'item_id' => ['required'],
            ]);

            $mail->update($data);

            return $mail;
        }

        public function destroy(Mail $mail)
        {
            $mail->delete();

            return response()->json();
        }*/
}
