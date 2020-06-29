<?php

namespace App\Repositories;

use App\Http\Requests\AdministratorRequest;
use App\Models\Administrator;

interface AdministratorRepositoryInterface
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index();

    /**
     * @param AdministratorRequest $administratorRequest
     */
    public function store( AdministratorRequest $administratorRequest );

    /**
     * @param Administrator $administrator
     * @return mixed
     */
    public function show( Administrator $administrator );

    /**
     * @param AdministratorRequest $administratorRequest
     * @param Administrator $administrator
     */
    public function update( AdministratorRequest $administratorRequest, Administrator $administrator );

    /**
     * @param Administrator $administrator
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy( Administrator $administrator );
}
