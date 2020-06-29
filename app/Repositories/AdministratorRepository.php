<?php

namespace App\Repositories;

use App\Http\Requests\AdministratorRequest;
use App\Http\Resources\AdministratorResource;
use App\Jobs\StoreAdministratorJob;
use App\Jobs\UpdateAdministratorJob;
use App\Models\Administrator;
use App\Traits\Relatives;

class AdministratorRepository implements AdministratorRepositoryInterface
{
    use Relatives;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return AdministratorResource::collection( Administrator::all() );
    }


    /**
     * @param AdministratorRequest $administratorRequest
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store( AdministratorRequest $administratorRequest )
    {
        return ( new StoreAdministratorJob( $administratorRequest ) ) -> handle();
    }

    /**
     * @param Administrator $administrator
     * @return AdministratorResource
     */
    public function show( Administrator $administrator )
    {
        if ( $this -> loadRelationships() ) { $administrator -> load( $this -> relationships ); }
        return new AdministratorResource( $administrator );
    }

    /**
     * @param AdministratorRequest $administratorRequest
     * @param Administrator $administrator
     */
    public function update( AdministratorRequest $administratorRequest, Administrator $administrator )
    {
        return ( new UpdateAdministratorJob( $administratorRequest, $administrator ) ) -> handle();
    }

    /**
     * @param Administrator $administrator
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy( Administrator $administrator )
    {
        try
        {
            $administrator -> delete();
            return response()->json('', 204);
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
