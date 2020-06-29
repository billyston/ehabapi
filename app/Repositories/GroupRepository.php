<?php

namespace App\Repositories;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Jobs\StoreGroupJob;
use App\Jobs\UpdateGroupJob;
use App\Models\Group;
use App\Traits\Relatives;

class GroupRepository implements GroupRepositoryInterface
{
    use Relatives;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function index()
    {
        return GroupResource::collection( Group::all() );
    }

    /**
     * @param GroupRequest $groupRequest
     * @return mixed
     */
    public function store( GroupRequest $groupRequest )
    {
        return ( new StoreGroupJob( $groupRequest ) ) -> handle();
    }

    /**
     * @param Group $group
     * @return GroupResource|mixed
     */
    public function show( Group $group )
    {
        if ( $this -> loadRelationships() ) { $group -> load( $this -> relationships ); }
        return new GroupResource( $group );
    }

    /**
     * @param GroupRequest $groupRequest
     * @param Group $group
     * @return mixed
     */
    public function update( GroupRequest $groupRequest, Group $group )
    {
        return ( new UpdateGroupJob( $groupRequest, $group ) ) -> handle();
    }

    /**
     * @param Group $group
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy( Group $group )
    {
        try
        {
            $group -> delete();
            return response()->json('', 204);
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
