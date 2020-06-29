<?php

namespace App\Jobs;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateServiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * UpdateServiceJob constructor.
     * @param ServiceRequest $serviceRequest
     * @param Service $service
     */
    public function __construct( ServiceRequest $serviceRequest, Service $service )
    {
        $this -> theRequest     = $serviceRequest;
        $this -> theModel       = $service;
    }

    /**
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function handle()
    {
        try
        {
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return response() -> json('', 204 );
        }

        catch ( \Exception $exception )
        {
            report( $exception );
            return abort(500, serverErrorMessage() );
        }
    }
}
