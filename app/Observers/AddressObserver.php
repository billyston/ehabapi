<?php

namespace App\Observers;

use App\Models\Address;

class AddressObserver
{
    /**
     * Handle the address "created" event.
     *
     * @param Address $address
     * @return void
     */
    public function creating( Address $address )
    {
        $address -> smart_id = uniqid();
    }

    /**
     * Handle the address "created" event.
     *
     * @param Address $address
     * @return void
     */
    public function created( Address $address )
    {
        //
    }

    /**
     * Handle the address "updated" event.
     *
     * @param Address $address
     * @return void
     */
    public function updated( Address $address )
    {
        //
    }

    /**
     * Handle the address "deleted" event.
     *
     * @param Address $address
     * @return void
     */
    public function deleted( Address $address )
    {
        //
    }

    /**
     * Handle the address "restored" event.
     *
     * @param Address $address
     * @return void
     */
    public function restored( Address $address )
    {
        //
    }

    /**
     * Handle the address "force deleted" event.
     *
     * @param Address $address
     * @return void
     */
    public function forceDeleted( Address $address )
    {
        //
    }
}
