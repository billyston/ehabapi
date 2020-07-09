<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\ScheduleResource;
use App\Models\Hospital;
use App\Models\Schedule;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface HospitalScheduleRepositoryInterface
{
    /**
     * @param array $service_id
     * @return AnonymousResourceCollection
     */
    public function index( $service_id = [] ): AnonymousResourceCollection;

    /**
     * @param Hospital $hospital
     * @param Schedule $schedule
     * @return ScheduleResource
     */
    public function show( Schedule $schedule ): ScheduleResource;
}
