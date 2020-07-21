<?php

namespace App\Jobs;

use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreClientJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * StoreClientJob constructor.
     * @param ClientRequest $clientRequest
     */
    public function __construct( ClientRequest $clientRequest )
    {
        $this -> theRequest = $clientRequest;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function handle()
    {
        try
        {
            // Store new client
            $Client = new Client( $this-> getAttributes()[ 'attributes' ] );
            $Client -> save();

            // Assign personnel to hospital(s) and group(s)
            $this -> attachHospitals( $Client, $this -> getAttributes()[ 'relationships' ][ 'hospital' ] );
            $this -> attachGroups( $Client, $this -> getAttributes()[ 'relationships' ][ 'group' ] );

            // Store next_of_kin
            ( new StoreNextOfKinJob( $this -> theRequest -> validated()[ 'data' ][ 'relationships' ][ 'next_of_kin' ][ 'data' ], $Client ) ) -> handle();

            // Store the address
            ( new StoreAddressJob( $this -> theRequest, $Client ) ) -> handle();

            // Store the phone
            ( new StorePhoneJob( $this -> theRequest, $Client ) ) -> handle();

            // Return the resource of the created model
            return response( new ClientResource( $Client ), 201 );
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
     * @param Client $client
     * @param array $hospitals
     */
    private function attachHospitals( Client $client, array $hospitals ): void
    {
        foreach ( $hospitals[ 'data' ] as $hospital )
        {
            $client -> hospital() -> attach( $hospital[ 'id' ] );
        }
    }

    /**
     * @param Client $client
     * @param array $groups
     */
    private function attachGroups( Client $client, array $groups ): void
    {
        foreach ( $groups[ 'data' ] as $group )
        {
            $client -> group() -> attach( $group[ 'id' ] );
        }
    }
}
