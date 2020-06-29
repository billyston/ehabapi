<?php

namespace App\Http\Controllers\SystemAdmins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Repositories\ScheduleRepositoryInterface;

class ScheduleController extends Controller
{
    private $theRepository;

    public function __construct ( ScheduleRepositoryInterface $scheduleRepository )
    {
        $this -> theRepository = $scheduleRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param ScheduleRequest $scheduleRequest
     * @return mixed
     */
    public function store( ScheduleRequest $scheduleRequest)
    {
        return $this -> theRepository -> store( $scheduleRequest );
    }

    /**
     * @param Schedule $schedule
     * @return mixed
     */
    public function show( Schedule $schedule )
    {
        return $this -> theRepository -> show( $schedule );
    }

    /**
     * @param ScheduleRequest $scheduleRequest
     * @param Schedule $schedule
     * @return mixed
     */
    public function update( ScheduleRequest $scheduleRequest, Schedule $schedule)
    {
        return $this -> theRepository -> update( $scheduleRequest, $schedule );
    }

    /**
     * @param Schedule $schedule
     * @return mixed
     */
    public function destroy( Schedule $schedule )
    {
        return $this -> theRepository -> destroy( $schedule );
    }
}
