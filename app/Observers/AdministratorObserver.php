<?php

namespace App\Observers;

use App\Models\Administrator;

class AdministratorObserver
{
    /**
     * @param Administrator $administrator
     */
    public function creating( Administrator $administrator )
    {
        $administrator -> smart_id = uniqid();
    }
}
