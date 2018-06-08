<?php

namespace App\Listeners;

use App\Events\RegisterEvent;
use App\PotatoLog;
use App\PotatoSetting;
use App\UserData;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterForPotatoListener
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
        $potatoSetting = PotatoSetting::where('type', 1)->first();

        if ($potatoSetting) {
            PotatoLog::create([
                'user_id' => $event->user->id,
                'setting_id' => 1,
                'num' => $potatoSetting['num']
            ]);
            UserData::where('user_id', $event->user->id)
                ->increment('potato_num', $potatoSetting['num']);
        }
    }
}
