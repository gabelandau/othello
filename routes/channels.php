<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('messages.{room}', function ($user, $room) {
    return $user;
});

Broadcast::channel('invites.{room}', function ($user, $room) {
    return $user;
});

Broadcast::channel('games.{room}', function ($user, $room) {
    return $user;
});

Broadcast::channel('invite-accepted.{room}', function ($user, $room) {
    return $user;
});
