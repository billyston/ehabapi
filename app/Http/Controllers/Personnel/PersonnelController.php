<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Traits\AuthenticatesJwtUsers;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    use AuthenticatesJwtUsers;

    /**
     * RegistrarController constructor.
     */
    public function __construct()
    {
        $this -> setGuardName( 'personnel' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        return "Returned Single";
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
        return "Updated";
    }
}
