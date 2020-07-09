<?php

namespace App\Jobs\Administrators;

use App\Http\Requests\Administrators\HospitalSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Hospital;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HospitalSpecialtyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * HospitalSpecialtyJob constructor.
     * @param HospitalSpecialtyRequest $hospitalSpecialtyRequest
     * @param Hospital $hospital
     */
    public function __construct( HospitalSpecialtyRequest $hospitalSpecialtyRequest, Hospital $hospital )
    {
        $this -> theRequest     = $hospitalSpecialtyRequest;
        $this -> theModel       = $hospital;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function handle()
    {
        try
        {
            $specialty = $this -> theModel -> specialty () -> create( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return response( new SpecialtyResource( $specialty ), 201 );
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return response('something went wrong, please try again later', 500);
        }
    }
}
