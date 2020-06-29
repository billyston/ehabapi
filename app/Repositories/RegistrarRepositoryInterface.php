<?php

namespace App\Repositories;

use App\Http\Requests\RegistrarRequest;
use App\Models\Registrar;

interface RegistrarRepositoryInterface
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index();

    /**
     * @param RegistrarRequest $registrarRequest
     * @return mixed
     */
    public function store( RegistrarRequest $registrarRequest );

    /**
     * @param Registrar $registrar
     * @return mixed
     */
    public function show( Registrar $registrar );

    /**
     * @param RegistrarRequest $registrarRequest
     * @param Registrar $registrar
     * @return mixed
     */
    public function update( RegistrarRequest $registrarRequest, Registrar $registrar );

    /**
     * @param Registrar $registrar
     * @return mixed
     */
    public function destroy( Registrar $registrar );
}
