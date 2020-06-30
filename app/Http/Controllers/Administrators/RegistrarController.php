<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrarRequest;
use App\Models\Registrar;
use App\Repositories\RegistrarRepositoryInterface;
use Illuminate\Http\Request;

class RegistrarController extends Controller
{
    private $theRepository;

    /**
     * RegistrarController constructor.
     * @param RegistrarRepositoryInterface $registrarRepository
     */
    public function __construct ( RegistrarRepositoryInterface $registrarRepository )
    {
        $this -> theRepository = $registrarRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param RegistrarRequest $registrarRequest
     * @return mixed
     */
    public function store( RegistrarRequest $registrarRequest )
    {
        return $this -> theRepository -> store( $registrarRequest );
    }

    /**
     * @param Registrar $registrar
     * @return mixed
     */
    public function show( Registrar $registrar )
    {
        return $this -> theRepository -> show( $registrar );
    }

    /**
     * @param RegistrarRequest $registrarRequest
     * @param Registrar $registrar
     * @return mixed
     */
    public function update( RegistrarRequest $registrarRequest, Registrar $registrar )
    {
        return $this -> theRepository -> update( $registrarRequest, $registrar );
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
