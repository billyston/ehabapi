<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\PersonnelResource;
use App\Models\Hospital;
use App\Models\Personnel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface HospitalPersonnelRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection;

    /**
     * @param Hospital $hospital
     * @param Personnel $personnel
     * @return PersonnelResource
     */
    public function show( Hospital $hospital, Personnel $personnel ): PersonnelResource;
}
