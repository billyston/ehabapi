<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrators\HospitalSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Jobs\Administrators\HospitalSpecialtyJob;
use App\Models\Hospital;
use App\Models\Specialty;
use App\Repositories\Administrators\HospitalSpecialtyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class HospitalSpecialtyController extends Controller
{
    private $theRepository;

    /**
     * HospitalSpecialtyController constructor.
     * @param HospitalSpecialtyRepositoryInterface $hospitalSpecialtyRepository
     */
    public function __construct( HospitalSpecialtyRepositoryInterface $hospitalSpecialtyRepository )
    {
        $this -> theRepository = $hospitalSpecialtyRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $hospital_ids = auth( 'administrator' ) -> user() -> hospital() -> pluck( 'hospitals.id' ) -> toArray();
        return $this -> theRepository -> index( $hospital_ids );
    }

    /**
     * @param HospitalSpecialtyRequest $hospitalSpecialtyRequest
     * @param Hospital $hospital
     * @return Response|null
     */
    public function store( HospitalSpecialtyRequest $hospitalSpecialtyRequest, Hospital $hospital ): ?Response
    {
        return $this -> dispatchNow( new HospitalSpecialtyJob( $hospitalSpecialtyRequest, $hospital ) );
    }

    /**
     * @param Hospital $hospital
     * @param Specialty $specialty
     * @return \App\Http\Resources\SpecialtyResource
     */
    public function show( Hospital $hospital, Specialty $specialty ) : SpecialtyResource
    {
        abort_unless($hospital -> id === $specialty -> hospital_id, 401,'special does not belong to hospital' );
        return $this -> theRepository -> show( $specialty );
    }

    /**
     * @param HospitalSpecialtyRequest $hospitalSpecialtyRequest
     * @param Hospital $hospital
     */
    public function update( HospitalSpecialtyRequest $hospitalSpecialtyRequest, Hospital $hospital )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        //
    }
}
