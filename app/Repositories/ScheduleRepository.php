<?php

namespace App\Repositories;

use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Jobs\StoreScheduleJob;
use App\Jobs\UpdateScheduleJob;
use App\Models\Schedule;
use App\Traits\Relatives;

class ScheduleRepository implements ScheduleRepositoryInterface
{
    use Relatives;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function index()
    {
        return ScheduleResource::collection( Schedule::all() );
    }

    /**
     * @param ScheduleRequest $scheduleRequest
     * @return ScheduleResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function store( ScheduleRequest $scheduleRequest )
    {
        return ( new StoreScheduleJob( $scheduleRequest ) ) -> handle();
    }

    /**
     * @param Schedule $schedule
     * @return ScheduleResource|mixed
     */
    public function show( Schedule $schedule )
    {
        if ( $this -> loadRelationships() ) { $schedule -> load( $this -> relationships ); }
        return new ScheduleResource( $schedule );
    }

    /**
     * @param ScheduleRequest $scheduleRequest
     * @param Schedule $schedule
     * @return mixed|void
     */
    public function update( ScheduleRequest $scheduleRequest, Schedule $schedule )
    {
        return ( new UpdateScheduleJob( $scheduleRequest, $schedule ) ) -> handle();
    }

    /**
     * @param Schedule $schedule
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy( Schedule $schedule )
    {
        try
        {
            $schedule -> delete();
            return response()->json('', 204);
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
