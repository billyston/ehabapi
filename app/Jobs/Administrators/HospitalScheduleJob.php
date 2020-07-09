<?php

namespace App\Jobs\Administrators;

use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HospitalScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * HospitalScheduleJob constructor.
     * @param ScheduleRequest $scheduleRequest
     * @param Schedule $schedule
     */
    public function __construct( ScheduleRequest $scheduleRequest, Schedule $schedule )
    {
        $this -> theRequest = $scheduleRequest;
        $this -> theModel   = $schedule;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function handle()
    {
        try
        {
            $Schedule = new Schedule( $this -> theRequest [ 'data.attributes' ] );
            $Schedule -> service() -> associate( $this -> theRequest [ 'data.relationships.service.id' ] );
            $Schedule -> save();

            // Return service resource
            return ( new ScheduleResource( $Schedule ) ) -> response() -> setStatusCode(201 );
        }

        catch ( \Exception $exception )
        {
            report( $exception );
            return response('something went wrong, please try again later', 500 );
        }
    }
}
