<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ResetPasswordChangedNotification;

class ResetPasswordChangedListener
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
    public function handle(PasswordReset $event): void
    {
        $event->user->notify(new ResetPasswordChangedNotification);
    }   
}
