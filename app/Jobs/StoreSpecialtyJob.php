<?php

namespace App\Jobs;

use App\Http\Requests\SpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Hospital;
use App\Models\Specialty;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreSpecialtyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * StoreSpecialtyJob constructor.
     * @param SpecialtyRequest $specialtyRequest
     * @param Hospital $hospital
     */
    public function __construct( SpecialtyRequest $specialtyRequest )
    {
        $this -> theRequest = $specialtyRequest;
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
            $Specialty = new Specialty( $this -> theRequest [ 'data.attributes' ] );
            $Specialty -> hospital() -> associate( $this -> theRequest [ 'data.relationships.hospital.id' ] );
            $Specialty -> save();

            // Return specialty resource
            return ( new SpecialtyResource( $Specialty ) ) -> response() -> setStatusCode(201 );
        }

        catch ( \Exception $exception )
        {
            report( $exception );
            return response('something went wrong, please try again later', 500 );
        }
    }
}
