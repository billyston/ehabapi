<?php

namespace App\Repositories;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;

interface ScheduleRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param ScheduleRequest $scheduleRequest
     * @return mixed
     */
    public function store( ScheduleRequest $scheduleRequest );

    /**
     * @param Schedule $schedule
     * @return mixed
     */
    public function show( Schedule $schedule );

    /**
     * @param ScheduleRequest $scheduleRequest
     * @param Schedule $schedule
     * @return mixed
     */
    public function update( ScheduleRequest $scheduleRequest, Schedule $schedule );

    /**
     * @param Schedule $schedule
     * @return mixed
     */
    public function destroy( Schedule $schedule );
}
