<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalClientRepository implements HospitalClientRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index (): AnonymousResourceCollection
    {
        return ClientResource::collection( Client::query() -> paginate( 20 ) );
    }

    /**
     * @param Client $client
     * @return ClientResource
     */
    public function show( Client $client ) : ClientResource
    {
        return new ClientResource( $client );
    }
}
