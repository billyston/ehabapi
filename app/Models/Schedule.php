<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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
    public function service(): BelongsTo
    {
        return $this -> belongsTo( Service::class );
    }

    /**
     * @return HasOneThrough
     */
    public function specialty(): HasOneThrough
    {
        return $this -> hasOneThrough(Specialty::class, Service::class);
    }

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
