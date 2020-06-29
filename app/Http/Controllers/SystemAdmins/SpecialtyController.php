<?php

namespace App\Http\Controllers\SystemAdmins;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialtyRequest;
use App\Models\Specialty;
use App\Repositories\SpecialtyRepositoryInterface;

class SpecialtyController extends Controller
{
    private $theRepository;

    /**
     * SpecialtyController constructor.
     * @param SpecialtyRepositoryInterface $specialtyRepository
     */
    public function __construct ( SpecialtyRepositoryInterface $specialtyRepository )
    {
        $this -> theRepository = $specialtyRepository;
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
     * @param SpecialtyRequest $specialtyRequest
     * @param Specialty $specialty
     * @return mixed
     */
    public function store( SpecialtyRequest $specialtyRequest )
    {
        return $this -> theRepository -> store( $specialtyRequest );
    }

    /**
     * @param Specialty $specialty
     * @return mixed
     */
    public function show( Specialty $specialty )
    {
        return $this -> theRepository -> show( $specialty );
    }

    /**
     * @param SpecialtyRequest $specialtyRequest
     * @param Specialty $specialty
     * @return mixed
     */
    public function update( SpecialtyRequest $specialtyRequest, Specialty $specialty )
    {
        return $this -> theRepository -> update( $specialtyRequest, $specialty );
    }

    /**
     * @param Specialty $specialty
     * @return mixed
     */
    public function destroy( Specialty $specialty )
    {
        return $this -> theRepository -> destroy( $specialty );
    }
}
