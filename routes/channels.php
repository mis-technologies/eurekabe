<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;


Broadcast::channel('chat', function () {
    return true;
});


Broadcast::channel('{channel}', function ($user, $channel) {

    Log::info('user joined channel', [$user->email, $channel]);

    // return $user !== null;  // or some condition to authorize the user
    $authorized = ( $user->email == $channel);
    Log::info('user joined channel', [$user->email, $channel, $authorized]);
    return $authorized;

});



Broadcast::routes(['middleware' => ['auth:sanctum']]);
