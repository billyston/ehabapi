<?php

namespace App\Jobs;

use App\Http\Requests\RegistrarRequest;
use App\Models\Registrar;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateRegistrarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest; private $theModel;

    /**
     * UpdateRegistrarJob constructor.
     * @param RegistrarRequest $registrarRequest
     * @param Registrar $registrar
     */
    public function __construct( RegistrarRequest $registrarRequest, Registrar $registrar )
    {
        $this -> theRequest     = $registrarRequest;
        $this -> theModel       = $registrar;
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
