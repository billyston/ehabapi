<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Client extends User
{
    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }

    /**
     * @return BelongsToMany
     */
    public function hospital(): BelongsToMany
    {
        return $this -> belongsToMany(Hospital::class);
    }

    /**
     * @return HasMany
     */
    public function next_of_kin(): HasOne
    {
        return $this -> hasOne( NextOfKin::class );
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsToMany
    {
        return $this -> belongsToMany(Group::class );
    }

    /**
     * @return MorphOne
     */
    public function address()
    {
        return $this -> morphOne( Address::class, 'addressable' );
    }

    /**
     * @return MorphOne
     */
    public function phone()
    {
        return $this -> morphOne( Phone::class, 'phoneable' );
    }
}
