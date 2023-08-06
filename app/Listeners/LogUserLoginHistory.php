<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Models\LoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LogUserLoginHistory 
{
    use InteractsWithQueue;
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
    public function handle(UserLoggedIn $event)
    {
    //     $user = $event->user;

    //     // Store the login history in the login_history table
    //    $loginHistory = LoginHistory::create([
    //         'user_id' => $user->id,
    //         'name' => $user->username,
    //         'login_at' => now(),

    //     ]);
    // $loginHistory->save();


    DB::table('login_history')->insert([
        'user_id' => auth()->user()->id,
        'name' => auth()->user()->username,
        'login_at' => now(),
    ]);


    }
}