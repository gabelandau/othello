<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\BoardUpdated;
use App\Events\MessageSent;

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
        $this->changedPieces = array();
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

        $user = $request->user();

        $game = DB::table('games')
            ->where('games.id', '=', $id)
            ->join('users as u1', 'u1.id', '=', 'games.initiator')
            ->join('users as u2', 'u2.id', '=', 'games.player')
            ->join('users as u3', 'u3.id', '=', 'games.current_turn')
            ->select('games.id', 'games.board', 'u1.username as initiator', 'u2.username as player', 'u3.username as current_turn', 'games.created_at')
            ->first();

        if(!is_null($game)) {
            $color;
            if ($game->initiator == $user->username) {
                $color = 'white';
            } else {
                $color = 'black';
            }

            $game->color = $color;

            return view('game', ['game' => $game]);
        } else {
            return redirect('/');
        }
    }

    public function makeMove(Request $request, int $id)
    {
        // Check if user was part of the game
        // Check to make sure it was the users turn

        $game = DB::table('games')
            ->where('games.id', '=', $id)
            ->first();

        $user = $request->user();
        $board = json_decode($game->board, true);
        $piece = $request->all();

        $color;
        if ($game->initiator == $user->id) {
            $color = 'white';
        } else {
            $color = 'black';
        }

        $valid = $this->validatePiece($piece['x'], $piece['y'], $color, $board);

        if ($valid && $game->current_turn == $user->id) {
            foreach ($this->changedPieces as $key => $value) {
                $board[$key] = $value;
            }

            $newTurn;
            if ($game->current_turn == $game->initiator) {
                $newTurn = $game->player;
            } else {
                $newTurn = $game->initiator;
            }

            DB::table('games')
                ->where('games.id', '=', $id)
                ->update(['board' => json_encode($board)]);

            DB::table('games')
                ->where('games.id', '=', $id)
                ->update(['current_turn' => $newTurn]);

            $turn = DB::table('games')
                ->where('games.id', '=', $id)
                ->join('users as u1', 'u1.id', '=', 'games.current_turn')
                ->select('u1.username as current_turn')
                ->first();


            event(new BoardUpdated($board, $turn, $game->id));
            return json_encode($board);
        }

        return json_encode(false);
    }

    function validatePiece($x, $y, $color, $pieces)
    {
        $right = $this->checker($x, $y, $color, $pieces, array('x' => 1, 'y' => 0, 'direction' => 1), 'x');
        $left = $this->checker($x, $y, $color, $pieces, array('x' => -1, 'y' => 0, 'direction' => -1), 'x');
        $down = $this->checker($x, $y, $color, $pieces, array('x' => 0, 'y' => 1, 'direction' => 1), 'y');
        $up = $this->checker($x, $y, $color, $pieces, array('x' => 0, 'y' => -1, 'direction' => -1), 'y');

        if ($right || $left || $down || $up) {
            $this->changedPieces['' . $x . $y] = array('x' => $x, 'y' => $y, 'color' => $color);
            return true;
        };
        return false;
    }

    function checker($x, $y, $color, $pieces, $direction, $axis)
    {
        $cx = $x;
        $cy = $y;

        if (!isset($pieces['' . $cx + $direction['x'] . $cy + $direction['y']])) return false;

        $test = $pieces['' . $cx + $direction['x'] . $cy + $direction['y']];
        if ($test['color'] == $color) return false;
        $initialPiece = array('x' => $cx + $direction['x'], 'y' => $cy + $direction['y'], 'color' => $color);

        while (true) {
            if ($axis == 'x') {
                $cx += $direction['direction'];
            } else if ($axis == 'y') {
                $cy += $direction['direction'];
            } else if ($axis == 'both') {
                $cx += $direction['direction'];
                $cy += $direction['direction'];
            }

            if (!isset($pieces['' . $cx + $direction['x'] . $cy + $direction['y']])) return false;
            $test = $pieces['' . $cx + $direction['x'] . $cy + $direction['y']];

            if ($test['color'] == $color) {
                $this->changedPieces['' . $initialPiece['x'] . $initialPiece['y']] = $initialPiece;
                return true;
            };

            if ($cx > 8 || $cx < 0 || $cy > 8 || $cy < 0) break;

            $this->changedPieces['' . $cx + $direction['x'] . $cy + $direction['y']] = array('x' => $cx + $direction['x'], 'y' => $cy + $direction['y'], 'color' => $color);
        }

        return false;
    }
}
