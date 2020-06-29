<?php

namespace App\Jobs;

use App\Http\Requests\HospitalRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\Hospital;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreAddressJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data; private $model;

    /**
     * Create a new job instance.
     *
     * @param $Request
     * @param $Model
     */
    public function __construct( $Request, $Model )
    {
        $this -> data = $Request -> validated()['data']['relationships']['address']['data'];
        $this -> model = $Model;
    }

    /**
     * Execute the job.
     *
     * @return AddressResource|void
     */
    public function handle()
    {
        try
        {
            $Address = new Address( $this -> data[ 'attributes' ] );
            $Address -> country() -> associate( $this -> data['relationships']['country']['data']['id'] );
            $Address -> addressable() -> associate( $this -> model );
            $Address -> save();

            return new AddressResource( $Address );
        }

        Catch( \Exception $exception )
        {
            report( $exception );
            return abort( 500, serverErrorMessage() );
        }
    }
}
