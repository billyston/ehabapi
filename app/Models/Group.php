<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }

    /**
     * @return HasMany
     */
    public function client(): BelongsToMany
    {
        return $this -> belongsToMany( Client::class );
    }

    /**
     * @return HasMany
     */
    public function appointment(): HasMany
    {
        return $this -> hasMany( Appointment::class );
    }
}
