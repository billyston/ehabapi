<?php

namespace App\Jobs;

use App\Http\Requests\SpecialtyRequest;
use App\Models\Specialty;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateSpecialtyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * UpdateSpecialtyJob constructor.
     * @param SpecialtyRequest $specialtyRequest
     * @param Specialty $specialty
     */
    public function __construct( SpecialtyRequest $specialtyRequest, Specialty $specialty )
    {
        $this -> theRequest     = $specialtyRequest;
        $this -> theModel       = $specialty;
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
            return response() -> json('', 204 );
        }

        catch ( \Exception $exception )
        {
            report( $exception );
            return abort(500, serverErrorMessage() );
        }
    }
}
