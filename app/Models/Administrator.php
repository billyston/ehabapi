<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Administrator extends User
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
        return $this -> belongsToMany( Hospital::class );
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

    /**
     * @return MorphOne
     */
    public function file()
    {
        return $this -> morphOne( Phone::class, 'fileable' );
    }
}
