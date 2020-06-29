<?php

namespace App\Repositories;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Jobs\StoreServiceJob;
use App\Jobs\UpdateServiceJob;
use App\Models\Service;
use App\Traits\Relatives;

class ServiceRepository implements ServiceRepositoryInterface
{
    use Relatives;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function index()
    {
        return ServiceResource::collection( Service::all() );
    }

    /**
     * @param ServiceRequest $serviceRequest
     * @return mixed|void
     */
    public function store( ServiceRequest $serviceRequest )
    {
        return ( new StoreServiceJob( $serviceRequest ) ) -> handle();
    }

    /**
     * @param Service $service
     * @return ServiceResource|mixed
     */
    public function show( Service $service )
    {
        if ( $this -> loadRelationships() ) { $service -> load( $this -> relationships ); }
        return new ServiceResource( $service );
    }

    /**
     * @param ServiceRequest $serviceRequest
     * @param Service $service
     * @return mixed|void
     */
    public function update( ServiceRequest $serviceRequest, Service $service )
    {
        return ( new UpdateServiceJob( $serviceRequest, $service ) ) -> handle();
    }

    /**
     * @param Service $service
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy( Service $service )
    {
        try
        {
            $service -> delete();
            return response()->json('', 204 );
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
