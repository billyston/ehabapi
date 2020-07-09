<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Jobs\Administrators\HospitalServiceJob;
use App\Jobs\StoreServiceJob;
use App\Models\Hospital;
use App\Models\Service;
use App\Repositories\Administrators\HospitalServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalServiceController extends Controller
{
    private $theRepository;

    /**
     * HospitalServiceController constructor.
     * @param HospitalServiceRepositoryInterface $hospitalServiceRepository
     */
    public function __construct( HospitalServiceRepositoryInterface $hospitalServiceRepository )
    {
        $this -> theRepository = $hospitalServiceRepository;
    }

    /**
     * @param Hospital $hospital
     * @return AnonymousResourceCollection
     */
    public function index( Hospital $hospital ): AnonymousResourceCollection
    {
        return $this -> theRepository -> index( $hospital );
    }

    /**
     * @param ServiceRequest $serviceRequest
     * @param Hospital $hospital
     * @return mixed
     */
    public function store( ServiceRequest $serviceRequest, Hospital $hospital )
    {
        return $this -> dispatchNow( new HospitalServiceJob( $serviceRequest, $hospital ) );
    }

    /**
     * @param Hospital $hospital
     * @param Service $service
     * @return \App\Http\Resources\ServiceResource
     */
    public function show( Hospital $hospital, Service $service )
    {
        return $this -> theRepository -> show( $hospital, $service );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
