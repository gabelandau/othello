<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['body', 'sender'];

    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}