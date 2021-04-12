<?php

namespace App\Jobs;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreServiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * StoreServiceJob constructor.
     * @param ServiceRequest $serviceRequest
     */
    public function __construct( ServiceRequest $serviceRequest )
    {
        $this -> theRequest = $serviceRequest;
    }

    /**
     * @return ResponseFactory|JsonResponse|Response|object
     */
    public function handle()
    {
        try
        {
            $Service = new Service( $this -> theRequest [ 'data.attributes' ] );
            $Service -> specialty() -> associate( $this -> theRequest [ 'data.relationships.specialty.id' ] );
            $Service -> save();

            // Return service resource
            return ( new ServiceResource( $Service ) ) -> response() -> setStatusCode(201 );
        }

        catch ( Exception $exception )
        {
            report( $exception );
            return response('something went wrong, please try again later', 500 );
        }
    }
}
