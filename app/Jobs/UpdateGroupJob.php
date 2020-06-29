<?php

namespace App\Jobs;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateGroupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * UpdateGroupJob constructor.
     * @param GroupRequest $groupRequest
     * @param Group $group
     */
    public function __construct( GroupRequest $groupRequest, Group $group )
    {
        $this -> theRequest     = $groupRequest;
        $this -> theModel       = $group;
    }

    /**
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function handle()
    {
        try
        {
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return response()->json('', 204 );
        }

        catch ( \Exception $exception )
        {
            report( $exception );
            return abort(500, serverErrorMessage() );
        }
    }
}
