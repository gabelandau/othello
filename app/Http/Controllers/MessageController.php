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
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $game = $request->input('game');

        Message::create([
            'body'     => $request->input('body'),
            'game'     => $game,
            'sender'   => $user->id
        ]);

        $message = DB::table('messages')
            ->orderBy('created_at', 'desc')
            ->join('users', 'users.id', '=', 'messages.sender')
            ->select('messages.body', 'messages.created_at', 'users.username', 'messages.game')
            ->first();

        event(new MessageSent($message));
    }

    public function getPrevious(int $game)
    {
        $messages = DB::table('messages')
            ->orderBy('created_at', 'desc')
            ->where('messages.game', '=', $game)
            ->join('users', 'users.id', '=', 'messages.sender')
            ->select('messages.body', 'messages.created_at', 'users.username')
            ->take(10)
            ->get();

        return $messages;
    }
}
