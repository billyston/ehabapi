<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface HospitalSpecialtyRepositoryInterface
{
    /**
     * @param array $ids
     * @return AnonymousResourceCollection
     */
    public function index( array $ids = [] ): AnonymousResourceCollection;

    /**
     * @param Specialty $specialty
     * @return SpecialtyResource
     */
    public function show( Specialty $specialty ): SpecialtyResource;
}
