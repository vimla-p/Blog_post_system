<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class CreateUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreateUserEvent  $event
     * @return void
     */
    public function handle(CreateUserEvent $event)
    {
        $user = $event->users;
        $password = $event->password;
        // Mail::to($user)->send(new MailNotify($user));
        Mail::send([],['user' => $user, 'password' => $password], function ($message) use ($user,$password) {
            Log::info($user);
                $message->from('admin@gamil.com', 'admin');
                $message->subject("Welcome! user created $user->first_name $user->last_name!");
                $message->setBody("Hi, welcome $user->first_name  ! Your password is $password");
                $message->to($user->email);
        });
    }
}
