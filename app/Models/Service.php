<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Service extends Model
{
    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }

    /**
     * @return BelongsTo
     */
    public function specialty(): BelongsTo
    {
        return $this -> belongsTo( Specialty::class );
    }

    /**
     * @return HasOneThrough
     */
    public function hospital(): HasOneThrough
    {
        return $this -> hasOneThrough( Hospital::class, Specialty::class );
    }

    /**
     * @return BelongsTo
     */
    public function schedule(): HasMany
    {
        return $this -> hasMany( Schedule::class );
    }
}
