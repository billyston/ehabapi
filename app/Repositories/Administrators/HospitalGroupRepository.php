<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalGroupRepository implements HospitalGroupRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index (): AnonymousResourceCollection
    {
        return GroupResource::collection( Group::query() -> paginate( 20 ) );
    }

    /**
     * @param Group $group
     * @return GroupResource
     */
    public function show( Group $group ) : GroupResource
    {
        return new GroupResource( $group );
    }
}
