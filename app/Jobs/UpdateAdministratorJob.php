<?php

namespace App\Jobs;

use App\Http\Requests\AdministratorRequest;
use App\Models\Administrator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateAdministratorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * Create a new job instance.
     *
     * @param AdministratorRequest $administratorRequest
     * @param Administrator $administrator
     */
    public function __construct( AdministratorRequest $administratorRequest, Administrator $administrator )
    {
        $this -> theRequest     = $administratorRequest;
        $this -> theModel       = $administrator;
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
