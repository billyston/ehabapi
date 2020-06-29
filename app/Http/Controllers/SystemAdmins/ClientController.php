<?php

namespace App\Http\Controllers\SystemAdmins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;

class ClientController extends Controller
{
    private $theRepository;

    /**
     * ClientController constructor.
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct ( ClientRepositoryInterface $clientRepository )
    {
        $this -> theRepository = $clientRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param ClientRequest $clientRequest
     * @return mixed
     */
    public function store( ClientRequest $clientRequest )
    {
        return $this -> theRepository -> store( $clientRequest );
    }

    /**
     * @param Client $client
     * @return mixed
     */
    public function show( Client $client )
    {
        return $this -> theRepository -> show( $client );
    }

    /**
     * @param ClientRequest $clientRequest
     * @param Client $client
     * @return mixed
     */
    public function update( ClientRequest $clientRequest, Client $client )
    {
        return $this -> theRepository -> update( $clientRequest, $client );
    }

    /**
     * @param Client $client
     * @return mixed
     */
    public function destroy( Client $client )
    {
        return $this -> theRepository -> destroy( $client );
    }
}
