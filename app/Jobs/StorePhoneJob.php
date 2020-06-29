<?php

namespace App\Jobs;

use App\Http\Requests\HospitalRequest;
use App\Http\Resources\PhoneResource;
use App\Models\Hospital;
use App\Models\Phone;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StorePhoneJob implements ShouldQueue
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
        $this -> data = $Request -> validated()['data']['relationships']['phone']['data'];
        $this -> model = $Model;
    }

    /**
     * Execute the job.
     *
     * @return PhoneResource|void
     */
    public function handle()
    {
        try
        {
            $Phone = new Phone( $this -> data[ 'attributes' ] );
            $Phone -> phoneable() -> associate( $this -> model );
            $Phone -> save();

            return new PhoneResource( $Phone );
        }

        Catch( \Exception $exception )
        {
            report( $exception );
            return abort( 500, serverErrorMessage() );
        }
    }
}
