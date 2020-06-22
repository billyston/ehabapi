<?php

namespace App\Models;

use App\User;

class SystemAdmin extends User
{
    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }
}
