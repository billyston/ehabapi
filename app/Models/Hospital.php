<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Hospital extends Model
{
    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }

    /**
     * @return BelongsToMany
     */
    public function administrator(): BelongsToMany
    {
        return $this -> belongsToMany( Administrator::class );
    }

    /**
     * @return BelongsToMany
     */
    public function registrar(): BelongsToMany
    {
        return $this -> belongsToMany( Registrar::class );
    }

    /**
     * @return BelongsToMany
     */
    public function personnel(): BelongsToMany
    {
        return $this -> belongsToMany( Personnel::class );
    }

    /**
     * @return HasMany
     */
    public function specialty(): HasMany
    {
        return $this -> hasMany( Specialty::class );
    }

    /**
     * @return BelongsToMany
     */
    public function client(): BelongsToMany
    {
        return $this -> belongsToMany(Client::class);
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
