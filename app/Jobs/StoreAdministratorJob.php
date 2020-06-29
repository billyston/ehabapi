<?php

namespace App\Jobs;

use App\Http\Requests\AdministratorRequest;
use App\Http\Resources\AdministratorResource;
use App\Models\Administrator;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreAdministratorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * StoreAdministratorJob constructor.
     * @param AdministratorRequest $administratorRequest
     */
    public function __construct( AdministratorRequest $administratorRequest )
    {
        $this -> theRequest = $administratorRequest;
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
            // Store new administrator
            $Administrator = new Administrator( $this-> getAttributes()[ 'attributes' ] );
            $Administrator -> save();

            // Assign hospital(s) to administrator
            $this -> attachHospitals( $Administrator, $this -> getAttributes()[ 'relationships' ][ 'hospital' ] );

            // Store the address
            ( new StoreAddressJob( $this -> theRequest, $Administrator ) ) -> handle();

            // Store the phone
            ( new StorePhoneJob( $this -> theRequest, $Administrator ) ) -> handle();

            // Return administrator resource
            return ( new AdministratorResource( $Administrator ) ) -> response() -> setStatusCode(201 );
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
     * @param Administrator $administrator
     * @param array $hospitals
     */
    private function attachHospitals( Administrator $administrator, array $hospitals ): void
    {
        foreach ( $hospitals[ 'data' ] as $hospital )
        {
            $administrator -> hospital() -> attach( $hospital[ 'id' ] );
        }
    }
}
