<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface HospitalGroupRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection;

    /**
     * @param Group $group
     * @return GroupResource
     */
    public function show( Group $group ): GroupResource;
}
