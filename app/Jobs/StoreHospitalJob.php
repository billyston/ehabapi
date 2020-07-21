<?php

namespace App\Jobs;

use App\Http\Requests\HospitalRequest;
use App\Http\Resources\HospitalResource;
use App\Models\Hospital;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreHospitalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * Create a new job instance.
     *
     * @param HospitalRequest $hospitalRequest
     */
    public function __construct( HospitalRequest $hospitalRequest )
    {
        $this -> theRequest = $hospitalRequest;
    }

    /**
     * Execute the job.
     *
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function handle()
    {
        try
        {
            // Store new school
            $Hospital = new Hospital( $this -> theRequest -> input( 'data.attributes' ) );
            $Hospital -> save();

            // Store the address
            ( new StoreAddressJob( $this -> theRequest, $Hospital ) ) -> handle();

            // Store the phone
            ( new StorePhoneJob( $this -> theRequest, $Hospital ) ) -> handle();

            // Create a general group for hospital
//            ( new StoreGroupJob( '', $Hospital ) );

            // Return hospital resource
            $Hospital -> refresh();
            return ( new HospitalResource( $Hospital ) ) -> response() -> setStatusCode(201 );
        }

        Catch( \Exception $exception )
        {
            report( $exception );
            return abort(500, 'something went wrong, please try again later');
        }
    }
}
