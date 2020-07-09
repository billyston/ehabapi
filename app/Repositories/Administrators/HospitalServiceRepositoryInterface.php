<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\ServiceResource;
use App\Models\Hospital;
use App\Models\Service;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface HospitalServiceRepositoryInterface
{
    /**
     * @param Hospital $hospital
     * @return AnonymousResourceCollection
     */
    public function index( Hospital $hospital ): AnonymousResourceCollection;

    /**
     * @param Hospital $hospital
     * @param Service $service
     * @return ServiceResource
     */
    public function show( Hospital $hospital, Service $service ): ServiceResource;
}
