<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\PersonnelResource;
use App\Models\Hospital;
use App\Models\Personnel;
use App\Traits\Relatives;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalPersonnelRepository implements HospitalPersonnelRepositoryInterface
{
    use Relatives;

    /**
     * @return AnonymousResourceCollection
     */
    public function index (): AnonymousResourceCollection
    {
        return PersonnelResource::collection( Personnel::query() -> paginate( 20 ) );
    }

    /**
     * @param Hospital $hospital
     * @param Personnel $personnel
     * @return PersonnelResource
     */
    public function show( Hospital $hospital, Personnel $personnel ) : PersonnelResource
    {
        if ( $this -> loadRelationships() ) { $personnel -> load( $this -> relationships ); }
        return new PersonnelResource( $personnel );
    }
}
