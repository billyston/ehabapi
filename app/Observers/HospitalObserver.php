<?php

namespace App\Observers;

use App\Models\Hospital;

class HospitalObserver
{
    public function creating( Hospital $hospital )
    {
        $hospital -> smart_id = uniqid();
    }
}
