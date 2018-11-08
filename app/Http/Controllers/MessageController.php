<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        Message::create([
            'body'     => $request->input('body'),
            'sender'   => $user->id
        ]);

        $message = DB::table('messages')
            ->orderBy('created_at', 'desc')
            ->join('users', 'users.id', '=', 'messages.sender')
            ->select('messages.body', 'messages.created_at', 'users.username')
            ->first();

        event(new MessageSent($message));
    }

    public function getPrevious()
    {
        $messages = DB::table('messages')
            ->join('users', 'users.id', '=', 'messages.sender')
            ->select('messages.body', 'messages.created_at', 'users.username')
            ->take(10)
            ->get();

        return $messages;
    }
}
