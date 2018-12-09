<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['initiator', 'player', 'board', 'current_turn', 'ended', 'winner'];

    public function initiator()
    {
        return $this->belongsTo(User::class);
    }

    public function player()
    {
        return $this->belongsTo(User::class);
    }
}
