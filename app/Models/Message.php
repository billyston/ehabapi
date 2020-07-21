<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }

    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this -> belongsTo( Service::class );
    }

    /**
     * @return BelongsTo
     */
    public function appointment(): HasMany
    {
        return $this -> hasMany( Appointment::class );
    }
}
