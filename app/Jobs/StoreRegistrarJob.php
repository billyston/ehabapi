<?php

namespace App\Jobs;

use App\Http\Requests\RegistrarRequest;
use App\Http\Resources\RegistrarResource;
use App\Models\Registrar;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreRegistrarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * StoreRegistrarJob constructor.
     * @param RegistrarRequest $registrarRequest
     */
    public function __construct( RegistrarRequest $registrarRequest )
    {
        $this -> theRequest = $registrarRequest;
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
            // Store new registrar
            $Registrar = new Registrar( $this-> getAttributes()[ 'attributes' ] );
            $Registrar -> save();

            // Assign hospital(s) to registrar
            $this -> attachHospitals( $Registrar, $this -> getAttributes()[ 'relationships' ][ 'hospital' ] );

            // Store the address
            ( new StoreAddressJob( $this -> theRequest, $Registrar ) ) -> handle();

            // Store the phone
            ( new StorePhoneJob( $this -> theRequest, $Registrar ) ) -> handle();

            // Return administrator resource
            return ( new RegistrarResource( $Registrar ) ) -> response() -> setStatusCode(201 );
        }

        catch ( Exception $exception )
        {
            report( $exception );
            return response( 'something went wrong, please try again later', 500 );
        }
    }

    /**
     * @return array
     */
    private function getAttributes(): array
    {
        $data = $this -> theRequest -> validated()[ 'data' ];
        return $data;
    }

    /**
     * @param Registrar $registrar
     * @param array $hospitals
     */
    private function attachHospitals( Registrar $registrar, array $hospitals ): void
    {
        foreach ( $hospitals[ 'data' ] as $hospital )
        {
            $registrar -> hospital() -> attach( $hospital[ 'id' ] );
        }
    }
}
