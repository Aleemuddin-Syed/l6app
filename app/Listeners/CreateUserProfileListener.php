<?php

namespace App\Listeners;

use App\Providers\UserRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\UserProfile;


class CreateUserProfileListener
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
     * @param  UserRegisteredEvent  $event
     * @return void
     */
    public function handle(UserRegisteredEvent $event)
    {
        $userProfile = new UserProfile([
            'user_id'=>$event->user->id,
            'country_id' => 1,
            'city'  =>  'default',
            'phone' =>  '098493853',
            'photo' =>  'profiles/dummy.jpg',
        ]);
        $event->user->profile()->save($userProfile);
    }
}
