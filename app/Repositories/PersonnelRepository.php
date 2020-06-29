<?php

namespace App\Repositories;

use App\Http\Requests\PersonnelRequest;
use App\Http\Resources\PersonnelResource;
use App\Jobs\StorePersonnelJob;
use App\Jobs\UpdatePersonnelJob;
use App\Models\Personnel;
use App\Traits\Relatives;

class PersonnelRepository implements PersonnelRepositoryInterface
{
    use Relatives;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PersonnelResource::collection( Personnel::all() );
    }

    /**
     * @param PersonnelRequest $personnelRequest
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function store( PersonnelRequest $personnelRequest )
    {
        return ( new StorePersonnelJob( $personnelRequest ) ) -> handle();
    }

    /**
     * @param Personnel $personnel
     * @return PersonnelResource|mixed
     */
    public function show( Personnel $personnel )
    {
        if ( $this -> loadRelationships() ) { $personnel -> load( $this -> relationships ); }
        return new PersonnelResource( $personnel );
    }

    /**
     * @param PersonnelRequest $personnelRequest
     * @param Personnel $personnel
     * @return mixed|void
     */
    public function update( PersonnelRequest $personnelRequest, Personnel $personnel )
    {
        return ( new UpdatePersonnelJob( $personnelRequest, $personnel ) ) -> handle();
    }

    /**
     * @param Personnel $personnel
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy( Personnel $personnel )
    {
        try
        {
            $personnel -> delete();
            return response()->json('', 204);
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
