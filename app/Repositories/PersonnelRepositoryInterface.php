<?php

namespace App\Repositories;

use App\Http\Requests\PersonnelRequest;
use App\Models\Personnel;

interface PersonnelRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param PersonnelRequest $personnelRequest
     * @return mixed
     */
    public function store( PersonnelRequest $personnelRequest );

    /**
     * @param Personnel $personnel
     * @return mixed
     */
    public function show( Personnel $personnel );

    /**
     * @param PersonnelRequest $personnelRequest
     * @param Personnel $personnel
     * @return mixed
     */
    public function update( PersonnelRequest $personnelRequest, Personnel $personnel );

    /**
     * @param Personnel $personnel
     * @return mixed
     */
    public function destroy( Personnel $personnel );
}
