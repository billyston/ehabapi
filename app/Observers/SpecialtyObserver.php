<?php

namespace App\Observers;

use App\Models\Specialty;

class SpecialtyObserver
{
    public function creating( Specialty $specialty )
    {
        $specialty -> smart_id = uniqid();
    }
}
