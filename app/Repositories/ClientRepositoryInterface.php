<?php

namespace App\Repositories;

use App\Http\Requests\ClientRequest;
use App\Models\Client;

interface ClientRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param ClientRequest $clientRequest
     * @return mixed
     */
    public function store( ClientRequest $clientRequest );

    /**
     * @param Client $client
     * @return mixed
     */
    public function show( Client $client );

    /**
     * @param ClientRequest $clientRequest
     * @param Client $client
     * @return mixed
     */
    public function update( ClientRequest $clientRequest, Client $client );

    /**
     * @param Client $client
     * @return mixed
     */
    public function destroy( Client $client );
}
