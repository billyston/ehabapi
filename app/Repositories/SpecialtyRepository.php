<?php

namespace App\Repositories;

use App\Http\Requests\SpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Jobs\StoreSpecialtyJob;
use App\Jobs\UpdateSpecialtyJob;
use App\Models\Hospital;
use App\Models\Specialty;
use App\Traits\Relatives;

class SpecialtyRepository implements SpecialtyRepositoryInterface
{
    use Relatives;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function index()
    {
        return SpecialtyResource::collection( Specialty::all() );
    }

    /**
     * @param SpecialtyRequest $specialtyRequest
     * @param Specialty $specialty
     * @return \Illuminate\Http\JsonResponse|mixed|object
     */
    public function store( SpecialtyRequest $specialtyRequest )
    {
        return ( new StoreSpecialtyJob( $specialtyRequest ) ) -> handle();
    }

    /**
     * @param Specialty $specialty
     * @return SpecialtyResource|mixed
     */
    public function show( Specialty $specialty )
    {
        if ( $this -> loadRelationships() ) { $specialty -> load( $this -> relationships ); }
        return new SpecialtyResource( $specialty );
    }

    /**
     * @param SpecialtyRequest $specialtyRequest
     * @param Specialty $specialty
     * @return mixed|void
     */
    public function update( SpecialtyRequest $specialtyRequest, Specialty $specialty )
    {
        return ( new UpdateSpecialtyJob( $specialtyRequest, $specialty ) ) -> handle();
    }

    /**
     * @param Specialty $specialty
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy( Specialty $specialty )
    {
        try
        {
            $specialty -> delete();
            return response()->json('', 204);
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
