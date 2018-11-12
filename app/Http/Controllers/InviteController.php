<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invite;
use App\Game;
use App\Events\InviteSent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InviteController extends Controller
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
        $initiator = $request->user();
        $player = $request->input('player');

        Invite::create([
            'player'     => $player,
            'initiator'  => $initiator->id
        ]);

        $invite = DB::table('invites')
            ->orderBy('invites.created_at', 'desc')
            ->join('users', 'users.id', '=', 'invites.initiator')
            ->select('invites.id', 'users.username', 'invites.player', 'invites.created_at')
            ->first();

        event(new InviteSent($invite));
        return response('Your invite has been sent!', 200);
    }

    public function getPrevious(Request $request)
    {
        $messages = DB::table('invites')
            ->where('invites.player', '=', $request->user()->id)
            ->orderBy('invites.created_at', 'desc')
            ->join('users', 'users.id', '=', 'invites.initiator')
            ->select('invites.id', 'users.username', 'invites.player', 'invites.created_at')
            ->get();

        return $messages;
    }

    public function accept(Request $request, int $id)
    {
        $user = $request->user();

        $invite = DB::table('invites')
            ->where('invites.id', '=', $id)
            ->orderBy('invites.created_at', 'desc')
            ->first();

        if ($invite->player != $user->id) {
            return response('Unauthorized to accept invitation', 403);
        }

        $game = Game::create([
            'initiator' => $invite->initiator,
            'player'    => $invite->player
        ]);

        if (!is_null($game)) {
            DB::table('invites')->where('invites.id', '=', $invite->id)->delete();
        }

        return response(array('user' => $request->user()->id, 'game' => $game), 200);
    }
}
