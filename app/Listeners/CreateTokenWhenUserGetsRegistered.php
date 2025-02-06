<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;

class CreateTokenWhenUserGetsRegistered
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handleUserVerified(Verified $event): void
    {
        //Generate token
        $event->user->createToken('open_token');
    }
}
