<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function fileTo()
    {
        return $this -> morphTo();
    }
}
