<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BoardUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $board;
    public $gameId;
    public $turn;
    public $win;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($board, $turn, $gameId, $win)
    {
        $this->board = $board;
        $this->turn = $turn;
        $this->gameId = $gameId;
        $this->win = $win;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('games.' . $this->gameId);
    }
}
