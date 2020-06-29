<?php

namespace App\Observers;

use App\Models\Schedule;

class ScheduleObserver
{
    public function creating( Schedule $schedule )
    {
        $schedule -> smart_id = uniqid();
    }
}
