<?php

namespace App\Repositories;

use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Jobs\StoreClientJob;
use App\Jobs\UpdateClientJob;
use App\Models\Client;
use App\Traits\Relatives;

class ClientRepository implements ClientRepositoryInterface
{
    use Relatives;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function index()
    {
        return ClientResource::collection( Client::all() );
    }

    /**
     * @param ClientRequest $clientRequest
     * @return mixed|void
     */
    public function store( ClientRequest $clientRequest )
    {
        return ( new StoreClientJob( $clientRequest ) ) -> handle();
    }

    /**
     * @param Client $client
     * @return ClientResource|mixed
     */
    public function show( Client $client )
    {
        if ( $this -> loadRelationships() ) { $client -> load( $this -> relationships ); }
        return new ClientResource( $client );
    }

    /**
     * @param ClientRequest $clientRequest
     * @param Client $client
     * @return mixed|void
     */
    public function update( ClientRequest $clientRequest, Client $client )
    {
        return ( new UpdateClientJob( $clientRequest, $client ) ) -> handle();
    }

    /**
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy( Client $client )
    {
        try
        {
            $client -> delete();
            return response()->json('', 204);
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
