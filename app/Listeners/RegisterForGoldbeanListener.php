<?php

namespace App\Listeners;

use App\Events\RegisterEvent;
use App\GoldbeanLog;
use App\UserData;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterForGoldbeanListener
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
     * @param  RegisterEvent  $event
     * @return void
     */
    public function handle(RegisterEvent $event)
    {
        $goldbeanSetting = 0.01;

        if ($goldbeanSetting) {
            GoldbeanLog::create([
                'user_id' => $event->user->id,
                'type' => 1,
                'num' => $goldbeanSetting['num']
            ]);
            UserData::where('user_id', $event->user->id)
                ->increment('gold_num', $goldbeanSetting['num']);
        }

    }
}
