<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\PersonnelResource;
use App\Models\Personnel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalPersonnelRepository implements HospitalPersonnelRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index (): AnonymousResourceCollection
    {
        return PersonnelResource::collection( Personnel::query() -> paginate( 20 ) );
    }

    /**
     * @param Personnel $personnel
     * @return PersonnelResource
     */
    public function show( Personnel $personnel ) : PersonnelResource
    {
        return new PersonnelResource( $personnel );
    }
}
