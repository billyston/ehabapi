<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Personnel extends User
{
    protected $guarded = [ 'id' ];
    public const ROLES = [ 'doctor' => 'doctor', 'nurse' => 'nurse', 'midwife' => 'midwife', 'surgeon' => 'surgeon' ];

    /**
     * @return string
     */
    public function getRouteKeyName (){ return 'smart_id'; }

    /**
     * @return BelongsTo
     */
    public function hospital(): BelongsToMany
    {
        return $this -> belongsToMany(Hospital::class );
    }

    /**
     * @return BelongsTo
     */
    public function schedule(): BelongsToMany
    {
        return $this -> belongsToMany(Schedule::class );
    }

    /**
     * @return BelongsTo
     */
    public function doctorService(): BelongsToMany
    {
        return $this -> belongsToMany(Service::class );
    }


    /**
     * @return BelongsTo
     */
    public function service(): HasManyThrough
    {
        return $this -> hasManyThrough(Service::class, Schedule::class );
    }

    /**
     * @return BelongsToMany
     */
    public function appointment(): BelongsToMany
    {
        return $this -> belongsToMany( Appointment::class );
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
