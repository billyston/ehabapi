<?php

namespace App\Http\Controllers\SystemAdmins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdministratorRequest;
use App\Models\Administrator;
use App\Repositories\AdministratorRepositoryInterface;

class AdministratorController extends Controller
{
    private $theRepository;

    /**
     * AdministratorController constructor.
     * @param AdministratorRepositoryInterface $administratorRepository
     */
    public function __construct ( AdministratorRepositoryInterface $administratorRepository )
    {
        $this -> theRepository = $administratorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return $this -> theRepository -> index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdministratorRequest $administratorRequest
     * @return \Illuminate\Http\Response
     */
    public function store( AdministratorRequest $administratorRequest )
    {
        return $this -> theRepository -> store( $administratorRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param Administrator $administrator
     * @return \App\Http\Resources\AdministratorResource
     */
    public function show( Administrator $administrator )
    {
        return $this -> theRepository -> show( $administrator );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdministratorRequest $administratorRequest
     * @param Administrator $administrator
     * @return \Illuminate\Http\Response
     */
    public function update( AdministratorRequest $administratorRequest, Administrator $administrator )
    {
        return $this -> theRepository -> update( $administratorRequest, $administrator );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Administrator $administrator
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy( Administrator $administrator )
    {
        return $this -> theRepository -> destroy( $administrator );
    }
}
