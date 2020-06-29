<?php

namespace App\Observers;

use App\Models\Registrar;

class RegistrarObserver
{
    /**
     * @param Registrar $registrar
     */
    public function creating( Registrar $registrar )
    {
        $registrar -> smart_id = uniqid();
    }
}
