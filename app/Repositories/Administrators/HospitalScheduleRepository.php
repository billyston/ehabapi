<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalScheduleRepository implements HospitalScheduleRepositoryInterface
{
    /**
     * @param array $service_id
     * @return AnonymousResourceCollection
     */
    public function index ( $service_id = [] ): AnonymousResourceCollection
    {
        return ScheduleResource::collection( Schedule::query() -> when( count( $service_id ), static function ( Builder $builder ) use ( $service_id ) { return $builder -> whereIn( 'service_id', $service_id ); } ) -> paginate( 20 ) );
    }

    /**
     * @param Schedule $schedule
     * @return ScheduleResource
     */
    public function show(Schedule $schedule ): ScheduleResource
    {
        return new ScheduleResource( $schedule );
    }
}
