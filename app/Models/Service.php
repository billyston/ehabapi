<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this -> belongsTo(Specialty::class );
    }

    /**
     * @return BelongsTo
     */
    public function schedule(): HasMany
    {
        return $this -> hasMany(Schedule::class );
    }

    /**
     * @return BelongsTo
     */
    public function personnel(): BelongsToMany
    {
        return $this -> BelongsToMany(Personnel::class );
    }
}
