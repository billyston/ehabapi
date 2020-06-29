<?php

namespace App\Observers;

use App\Models\Appointment;

class AppointmentObserver
{
    public function creating( Appointment $appointment )
    {
        $appointment -> smart_id = uniqid();
    }
}
