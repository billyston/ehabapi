<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialty extends Model
{
    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }

    /**
     * @return BelongsTo
     */
    public function hospital(): BelongsTo
    {
        return $this -> belongsTo(Hospital::class );
    }

    /**
     * @return HasMany
     */
    public function service(): HasMany
    {
        return $this -> hasMany( Service::class );
    }
}
