<?php

namespace App\Http\Controllers\SystemAdmins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Repositories\ServiceRepositoryInterface;

class ServiceController extends Controller
{
    private $theRepository;

    /**
     * ServiceController constructor.
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct ( ServiceRepositoryInterface $serviceRepository )
    {
        $this -> theRepository = $serviceRepository;
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
     * @param ServiceRequest $serviceRequest
     * @return mixed
     */
    public function store( ServiceRequest $serviceRequest )
    {
        return $this -> theRepository -> store( $serviceRequest );
    }

    /**
     * @param Service $service
     * @return mixed
     */
    public function show( Service $service )
    {
        return $this -> theRepository -> show( $service );
    }

    /**
     * @param ServiceRequest $serviceRequest
     * @param Service $service
     * @return mixed
     */
    public function update( ServiceRequest $serviceRequest, Service $service )
    {
        return $this -> theRepository -> update( $serviceRequest, $service );
    }

    /**
     * @param Service $service
     * @return mixed
     */
    public function destroy( Service $service )
    {
        return $this -> theRepository -> destroy( $service );
    }
}
