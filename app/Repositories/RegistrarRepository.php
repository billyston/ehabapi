<?php

namespace App\Repositories;

use App\Http\Requests\RegistrarRequest;
use App\Http\Resources\RegistrarResource;
use App\Jobs\StoreRegistrarJob;
use App\Jobs\UpdateRegistrarJob;
use App\Models\Registrar;
use App\Traits\Relatives;

class RegistrarRepository implements RegistrarRepositoryInterface
{
    use Relatives;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return RegistrarResource::collection( Registrar::all() );
    }

    /**
     * @param RegistrarRequest $registrarRequest
     * @return \Illuminate\Http\JsonResponse|mixed|object
     */
    public function store( RegistrarRequest $registrarRequest )
    {
        return ( new StoreRegistrarJob( $registrarRequest ) ) -> handle();
    }

    /**
     * @param Registrar $registrar
     * @return RegistrarResource|mixed
     */
    public function show( Registrar $registrar )
    {
        if ( $this -> loadRelationships() ) { $registrar -> load( $this -> relationships ); }
        return new RegistrarResource( $registrar );
    }

    /**
     * @param RegistrarRequest $registrarRequest
     * @param Registrar $registrar
     * @return mixed|void
     */
    public function update( RegistrarRequest $registrarRequest, Registrar $registrar )
    {
        return ( new UpdateRegistrarJob( $registrarRequest, $registrar ) ) -> handle();
    }

    /**
     * @param Registrar $registrar
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy( Registrar $registrar )
    {
        try
        {
            $registrar -> delete();
            return response()->json('', 204);
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
