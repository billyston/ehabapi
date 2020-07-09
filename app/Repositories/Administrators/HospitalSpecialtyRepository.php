<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
use App\Traits\Relatives;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalSpecialtyRepository implements HospitalSpecialtyRepositoryInterface
{
    use Relatives;

    /**
     * @param array $ids
     * @return AnonymousResourceCollection
     */
    public function index ( array $ids = [] ): AnonymousResourceCollection
    {
        $specialty = Specialty::query() -> when( count( $ids ), static function ( Builder $builder ) use ( $ids ) { return $builder -> whereIn( 'hospital_id', $ids ); } ) -> paginate( 20 );
        return SpecialtyResource::collection( $specialty );
    }

    /**
     * @param Specialty $specialty
     * @return SpecialtyResource
     */
    public function show( Specialty $specialty ): SpecialtyResource
    {
        if ( $this -> loadRelationships() ) { $specialty -> load( $this -> relationships ); }
        return new SpecialtyResource( $specialty );
    }
}
