<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
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

    public function list(Request $request)
    {
        $user = $request->user();

        $games = DB::table('games')
            ->where('games.player', '=', $user->id)
            ->orWhere('games.initiator', '=', $user->id)
            ->join('users as u1', 'u1.id', '=', 'games.initiator')
            ->join('users as u2', 'u2.id', '=', 'games.player')
            ->select('games.id', 'u1.username as initiator', 'u2.username as player', 'games.created_at')
            ->get();

        return $games;
    }

    public function show(Request $request, int $id)
    {
        if ($id == 1) {
            return redirect('/');
        }

        return view('game', ['game' => $id]);
    }
}
