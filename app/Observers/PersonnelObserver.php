<?php

namespace App\Observers;

use App\Models\Personnel;

class PersonnelObserver
{
    public function creating( Personnel $personnel )
    {
        $personnel -> smart_id = uniqid();
    }
}
