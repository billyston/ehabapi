<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Traits\AuthenticatesJwtUsers;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    use AuthenticatesJwtUsers;

    /**
     * AdministratorController constructor.
     */
    public function __construct()
    {
        $this -> setGuardName( 'administrator' );
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
