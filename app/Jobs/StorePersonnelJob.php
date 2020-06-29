<?php

namespace App\Jobs;

use App\Http\Requests\PersonnelRequest;
use App\Http\Resources\PersonnelResource;
use App\Models\Personnel;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StorePersonnelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * StorePersonnelJob constructor.
     * @param PersonnelRequest $personnelRequest
     */
    public function __construct( PersonnelRequest $personnelRequest )
    {
        $this -> theRequest = $personnelRequest;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function handle()
    {
        try
        {
            // Store new personnel
            $Personnel = new Personnel( $this-> getAttributes()[ 'attributes' ] );
            $Personnel -> specialty() -> associate( $this -> theRequest [ 'data.relationships.specialty.data.id' ] );
            $Personnel -> save();

            // Assign hospital(s) to personnel
            $this -> attachHospitals( $Personnel, $this -> getAttributes()[ 'relationships' ][ 'hospital' ] );

            // Assign hospital(s) to personnel
            $this -> attachService( $Personnel, $this -> getAttributes()[ 'relationships' ][ 'service' ] );

            // Assign hospital(s) to personnel
            $this -> attachSchedules( $Personnel, $this -> getAttributes()[ 'relationships' ][ 'schedule' ] );

            // Store the address
            ( new StoreAddressJob( $this -> theRequest, $Personnel ) ) -> handle();

            // Store the phone
            ( new StorePhoneJob( $this -> theRequest, $Personnel ) ) -> handle();

            // Return personnel resource
            return ( new PersonnelResource( $Personnel ) ) -> response() -> setStatusCode(201 );
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
        $data = $this -> theRequest -> validated()['data'];
        return $data;
    }

    /**
     * @param Personnel $personnel
     * @param array $hospitals
     */
    private function attachHospitals( Personnel $personnel, array $hospitals ): void
    {
        foreach ( $hospitals[ 'data' ] as $hospital )
        {
            $personnel -> hospital() -> attach( $hospital[ 'id' ] );
        }
    }

    /**
     * @param Personnel $personnel
     * @param array $services
     */
    private function attachService( Personnel $personnel, array $services ): void
    {
        foreach ( $services[ 'data' ] as $service )
        {
            $personnel -> service() -> attach( $service[ 'id' ] );
        }
    }

    /**
     * @param Personnel $personnel
     * @param array $schedules
     */
    private function attachSchedules( Personnel $personnel, array $schedules ): void
    {
        foreach ( $schedules[ 'data' ] as $schedule )
        {
            $personnel -> schedule() -> attach( $schedule[ 'id' ] );
        }
    }
}
