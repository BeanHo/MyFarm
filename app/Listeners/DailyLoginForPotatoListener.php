<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use App\PotatoLog;
use App\PotatoSetting;
use App\UserData;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyLoginForPotatoListener
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
     * @param  LoginEvent  $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        $user_id = $event->user->id;
        $dailyLogin = PotatoLog::where('user_id', $user_id)
            ->where('setting_id', 2)
            ->whereDate('created_at', today()->toDateString())
            ->first();
        $potatoSetting = PotatoSetting::where('type', 2)->first();

        if (!$dailyLogin && $potatoSetting) {
            PotatoLog::create([
                'user_id' => $user_id,
                'setting_id' => 2,
                'num' => $potatoSetting['num']
            ]);
            UserData::where('user_id', $user_id)
                ->increment('potato_num', $potatoSetting['num']);
        }
    }
}
