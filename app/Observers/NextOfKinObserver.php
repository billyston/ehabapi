<?php

namespace App\Observers;

use App\Models\NextOfKin;

class NextOfKinObserver
{
    public function creating( NextOfKin $nextOfKin )
    {
        $nextOfKin -> smart_id = uniqid();
    }
}
