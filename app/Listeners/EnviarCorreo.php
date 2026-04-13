<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\AlertaLoginCorreo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cache;

class EnviarCorreo
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
    public function handle(object $event): void
    {
        $user = $event->user;

        $key = 'login_' . $user->id;

        if (cache::has($key)) {
            return;
        }

        Cache::put($key, true, now()->addMinutes(10));

        Mail::to($user->email)->send(new AlertaLoginCorreo($user));
    }
}
