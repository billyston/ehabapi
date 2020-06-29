<?php

namespace App\Jobs;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * UpdateScheduleJob constructor.
     * @param ScheduleRequest $scheduleRequest
     * @param Schedule $schedule
     */
    public function __construct( ScheduleRequest $scheduleRequest, Schedule $schedule )
    {
        $this -> theRequest     = $scheduleRequest;
        $this -> theModel       = $schedule;
    }

    /**
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function handle()
    {
        try
        {
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return response() -> json('', 204 );
        }

        catch ( \Exception $exception )
        {
            report( $exception );
            return abort(500, serverErrorMessage() );
        }
    }
}
