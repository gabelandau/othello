<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = ['initiator', 'player'];

    public function initiator()
    {
        return $this->belongsTo(User::class);
    }

    public function player()
    {
        return $this->belongsTo(User::class);
    }
}
