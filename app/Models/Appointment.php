<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }

    /**
     * @return BelongsToMany
     */
    public function client(): BelongsToMany
    {
        return $this -> belongsToMany(Client::class );
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this -> belongsTo( Group::class );
    }

    /**
     * @return BelongsTo
     */
    public function schedule(): BelongsTo
    {
        return $this -> belongsTo( Schedule::class );
    }

    /**
     * @return BelongsTo
     */
    public function personnel(): BelongsTo
    {
        return $this -> belongsTo(Personnel::class );
    }
}
