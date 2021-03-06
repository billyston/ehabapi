<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonnelRequest;
use App\Http\Resources\PersonnelResource;
use App\Jobs\StorePersonnelJob;
use App\Models\Hospital;
use App\Models\Personnel;
use App\Repositories\Administrators\HospitalPersonnelRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HospitalPersonnelController extends Controller
{
    private $theRepository;

    /**
     * HospitalPersonnelController constructor.
     * @param HospitalPersonnelRepositoryInterface $hospitalPersonnelRepository
     */
    public function __construct( HospitalPersonnelRepositoryInterface $hospitalPersonnelRepository )
    {
        $this -> theRepository = $hospitalPersonnelRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param PersonnelRequest $personnelRequest
     * @return PersonnelResource
     */
    public function store( PersonnelRequest $personnelRequest ) : Response
    {
        return $this -> dispatchNow( new StorePersonnelJob( $personnelRequest ) );
    }

    /**
     * @param Hospital $hospital
     * @param Personnel $personnel
     * @return PersonnelResource
     */
    public function show( Hospital $hospital, Personnel $personnel )
    {
        return $this -> theRepository -> show( $hospital, $personnel );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
