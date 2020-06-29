<?php

namespace App\Repositories;

use App\Http\Requests\HospitalRequest;
use App\Http\Resources\HospitalResource;
use App\Jobs\StoreHospitalJob;
use App\Jobs\UpdateHospitalJob;
use App\Models\Hospital;
use App\Traits\Relatives;

class HospitalRepository implements HospitalRepositoryInterface
{
    use Relatives;

    // Get all hospital
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function index()
    {
        return HospitalResource::collection( Hospital::all() );
    }

    // Create new hospital
    /**
     * @param HospitalRequest $hospitalRequest
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store( HospitalRequest $hospitalRequest )
    {
        return ( new StoreHospitalJob( $hospitalRequest ) ) -> handle();
    }

    // Get single hospital
    /**
     * @param Hospital $hospital
     * @return HospitalResource|mixed
     */
    public function show( Hospital $hospital )
    {
        if ( $this -> loadRelationships() ) { $hospital -> load( $this -> relationships ); }
        return new HospitalResource( $hospital );
    }

    // Get single hospital
    /**
     * @param HospitalRequest $hospitalRequest
     * @param Hospital $hospital
     * @return mixed|void
     */
    public function update( HospitalRequest $hospitalRequest, Hospital $hospital )
    {
        return ( new UpdateHospitalJob( $hospitalRequest, $hospital ) ) -> handle();
    }

    // Delete hospital
    /**
     * @param Hospital $hospital
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy( Hospital $hospital )
    {
        try
        {
            $hospital -> delete();
            return response()->json('', 204);
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
