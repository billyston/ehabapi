<?php

namespace App\Observers;

use App\Models\Phone;

class PhoneObserver
{
    /**
     * Handle the address "created" event.
     *
     * @param Phone $phone
     * @return void
     */
    public function creating( Phone $phone )
    {
        $phone -> smart_id = uniqid();
    }

    /**
     * Handle the address "created" event.
     *
     * @param Address $phone
     * @return void
     */
    public function created( Phone $phone )
    {
        //
    }

    /**
     * Handle the address "updated" event.
     *
     * @param Address $phone
     * @return void
     */
    public function updated( Phone $phone )
    {
        //
    }

    /**
     * Handle the address "deleted" event.
     *
     * @param Phone $phone
     * @return void
     */
    public function deleted( Phone $phone )
    {
        //
    }

    /**
     * Handle the address "restored" event.
     *
     * @param Phone $phone
     * @return void
     */
    public function restored( Phone $phone )
    {
        //
    }

    /**
     * Handle the address "force deleted" event.
     *
     * @param Phone $phone
     * @return void
     */
    public function forceDeleted( Phone $phone )
    {
        //
    }
}
