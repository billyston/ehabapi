<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }

    /**
     * @return HasMany
     */
    public function personnel(): BelongsToMany
    {
        return $this -> belongsToMany( Personnel::class );
    }

    /**
     * @return HasMany
     */
    public function appointment(): HasMany
    {
        return $this -> hasMany( Appointment::class );
    }
}
