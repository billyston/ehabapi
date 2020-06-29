<?php

namespace App\Repositories;

use App\Http\Requests\HospitalRequest;
use App\Models\Hospital;

interface HospitalRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param HospitalRequest $hospitalRequest
     * @return mixed
     */
    public function store( HospitalRequest $hospitalRequest );

    /**
     * @param Hospital $hospital
     * @return mixed
     */
    public function show( Hospital $hospital );

    /**
     * @param HospitalRequest $hospitalRequest
     * @param Hospital $hospital
     * @return mixed
     */
    public function update( HospitalRequest $hospitalRequest, Hospital $hospital );

    /**
     * @param Hospital $hospital
     * @return mixed
     */
    public function destroy( Hospital $hospital );
}
