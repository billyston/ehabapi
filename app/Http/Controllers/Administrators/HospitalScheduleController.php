<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Jobs\Administrators\HospitalScheduleJob;
use App\Models\Schedule;
use App\Repositories\Administrators\HospitalScheduleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalScheduleController extends Controller
{
    private $theRepository;

    /**
     * HospitalScheduleController constructor.
     * @param HospitalScheduleRepositoryInterface $hospitalScheduleRepository
     */
    public function __construct( HospitalScheduleRepositoryInterface $hospitalScheduleRepository )
    {
        $this -> theRepository = $hospitalScheduleRepository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param ScheduleRequest $scheduleRequest
     * @param Schedule $schedule
     * @return mixed
     */
    public function store( ScheduleRequest $scheduleRequest, Schedule $schedule )
    {
        return $this -> dispatchNow( new HospitalScheduleJob( $scheduleRequest, $schedule ) );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
