<?php

namespace App\Repositories;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;

interface ServiceRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param ServiceRequest $serviceRequest
     * @return mixed
     */
    public function store( ServiceRequest $serviceRequest );

    /**
     * @param Service $service
     * @return mixed
     */
    public function show( Service $service );

    /**
     * @param ServiceRequest $serviceRequest
     * @param Service $service
     * @return mixed
     */
    public function update( ServiceRequest $serviceRequest, Service $service );

    /**
     * @param Service $service
     * @return mixed
     */
    public function destroy( Service $service );
}
