<?php

namespace App\Jobs;

use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * StoreScheduleJob constructor.
     * @param ScheduleRequest $scheduleRequest
     */
    public function __construct( ScheduleRequest $scheduleRequest )
    {
        $this -> theRequest = $scheduleRequest;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function handle()
    {
        try
        {
            $Schedule = new Schedule( $this -> theRequest [ 'data.attributes' ] );
            $Schedule -> service() -> associate( $this -> theRequest [ 'data.relationships.service.data.id' ] );
            $Schedule -> save();

            // Return schedule resource
            return ( new ScheduleResource( $Schedule ) ) -> response() -> setStatusCode(201 );
        }

        catch ( \Exception $exception )
        {
            report( $exception );
            return response( 'something went wrong, please try again later', 500 );
        }
    }
}
