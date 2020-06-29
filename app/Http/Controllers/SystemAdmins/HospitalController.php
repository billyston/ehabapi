<?php

namespace App\Http\Controllers\SystemAdmins;

use App\Http\Controllers\Controller;
use App\Http\Requests\HospitalRequest;
use App\Models\Hospital;
use App\Repositories\HospitalRepositoryInterface;

class HospitalController extends Controller
{
    private $theRepository;

    /**
     * HospitalController constructor.
     * @param HospitalRepositoryInterface $hospitalRepository
     */
    public function __construct ( HospitalRepositoryInterface $hospitalRepository )
    {
        $this -> theRepository = $hospitalRepository;
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
     * Store a newly created resource in storage.
     *
     * @param HospitalRequest $hospitalRequest
     * @return \Illuminate\Http\Response
     */
    public function store( HospitalRequest $hospitalRequest )
    {
        return $this -> theRepository -> store( $hospitalRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param Hospital $hospital
     * @return \Illuminate\Http\Response
     */
    public function show( Hospital $hospital )
    {
        return $this -> theRepository -> show( $hospital );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HospitalRequest $hospitalRequest
     * @param Hospital $hospital
     * @return \Illuminate\Http\Response
     */
    public function update( HospitalRequest $hospitalRequest, Hospital $hospital )
    {
        return $this -> theRepository -> update( $hospitalRequest, $hospital );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hospital $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy( Hospital $hospital )
    {
        return $this -> theRepository -> destroy( $hospital );
    }
}
