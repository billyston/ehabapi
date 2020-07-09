<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\ServiceResource;
use App\Models\Hospital;
use App\Models\Service;
use App\Traits\Relatives;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalServiceRepository implements HospitalServiceRepositoryInterface
{
    use Relatives;

    /**
     * @param Hospital $hospital
     * @return AnonymousResourceCollection
     */
    public function index ( Hospital $hospital ): AnonymousResourceCollection
    {
        return ServiceResource::collection( $hospital -> service() -> paginate( 20 ) );
    }

    /**
     * @param Hospital $hospital
     * @param Service $service
     * @return ServiceResource
     */
    public function show( Hospital $hospital, Service $service ): ServiceResource
    {
        if ( $this -> loadRelationships() ) { $service -> load( $this -> relationships ); }
        return new ServiceResource( $service );
    }
}
