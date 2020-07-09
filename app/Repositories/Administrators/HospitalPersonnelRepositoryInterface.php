<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\PersonnelResource;
use App\Models\Personnel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface HospitalPersonnelRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection;

    /**
     * @param Personnel $personnel
     * @return PersonnelResource
     */
    public function show( Personnel $personnel ): PersonnelResource;
}
