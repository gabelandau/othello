<?php

use Illuminate\Foundation\Inspiring;
use App\Game;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('createLobby', function () {
    $game = Game::create([
        'initiator' => null,
        'player'    => null,
        'board'     => null
    ]);

    DB::table('games')
        ->where('id', '=', $game->id)
        ->update(['id' => 1]);
});

Artisan::command('resetBoard {id}', function ($id) {
    $board = array(
        '44' => array(
            'x' => 4,
            'y' => 4,
            'color' => 'white'
        ),
        '54' => array(
            'x' => 5,
            'y' => 4,
            'color' => 'black'
        ),
        '45' => array(
            'x' => 4,
            'y' => 5,
            'color' => 'black'
        ),
        '55' => array(
            'x' => 5,
            'y' => 5,
            'color' => 'white'
        )
    );

    DB::table('games')
        ->where('games.id', '=', $id)
        ->update(['board' => json_encode($board)]);
});
