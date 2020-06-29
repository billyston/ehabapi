<?php

namespace App\Jobs;

use App\Http\Requests\HospitalRequest;
use App\Models\Hospital;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateHospitalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * Create a new job instance.
     *
     * @param HospitalRequest $hospitalRequest
     * @param Hospital $hospital
     */
    public function __construct( HospitalRequest $hospitalRequest, Hospital $hospital )
    {
        $this -> theRequest     = $hospitalRequest;
        $this -> theModel       = $hospital;
    }

    /**
     * Execute the job.
     *
     * @return \Illuminate\Http\JsonResponse|object
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
