<?php

namespace App\Repositories;

use App\Http\Requests\SpecialtyRequest;
use App\Models\Hospital;
use App\Models\Specialty;

interface SpecialtyRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param SpecialtyRequest $specialtyRequest
     * @param Specialty $specialty
     * @return mixed
     */
    public function store( SpecialtyRequest $specialtyRequest );

    /**
     * @param Specialty $specialty
     * @return mixed
     */
    public function show( Specialty $specialty );

    /**
     * @param SpecialtyRequest $specialtyRequest
     * @param Specialty $specialty
     * @return mixed
     */
    public function update( SpecialtyRequest $specialtyRequest, Specialty $specialty );

    /**
     * @param Specialty $specialty
     * @return mixed
     */
    public function destroy( Specialty $specialty );
}
