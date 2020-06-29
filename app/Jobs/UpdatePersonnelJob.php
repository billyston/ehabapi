<?php

namespace App\Jobs;

use App\Http\Requests\PersonnelRequest;
use App\Models\Personnel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePersonnelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * UpdatePersonnelJob constructor.
     * @param PersonnelRequest $personnelRequest
     * @param Personnel $personnel
     */
    public function __construct( PersonnelRequest $personnelRequest, Personnel $personnel )
    {
        $this -> theRequest     = $personnelRequest;
        $this -> theModel       = $personnel;
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
