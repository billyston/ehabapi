<?php

namespace App\Jobs;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreGroupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * StoreGroupJob constructor.
     * @param GroupRequest $groupRequest
     */
    public function __construct( GroupRequest $groupRequest )
    {
        $this -> theRequest = $groupRequest;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function handle()
    {
        try
        {
            // Store new group
            $Group = new Group( $this -> theRequest [ 'data.attributes' ] );
            $Group -> save();
            $Group -> refresh();

            // Return group resource
            return response( new GroupResource( $Group ), 201 );
        }

        catch ( \Exception $exception )
        {
            report( $exception );
            return response( 'something went wrong, please try again later', 500 );
        }
    }
}
