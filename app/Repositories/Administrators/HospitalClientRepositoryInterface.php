<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface HospitalClientRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection;

    /**
     * @param Client $client
     * @return ClientResource
     */
    public function show( Client $client ): ClientResource;
}
