<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Jobs\StoreClientJob;
use App\Repositories\Administrators\HospitalClientRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HospitalClientController extends Controller
{
    private $theRepository;

    /**
     * HospitalClientController constructor.
     * @param HospitalClientRepositoryInterface $hospitalClientRepository
     */
    public function __construct( HospitalClientRepositoryInterface $hospitalClientRepository )
    {
        $this -> theRepository = $hospitalClientRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param ClientRequest $clientRequest
     * @return Response
     */
    public function store( ClientRequest $clientRequest ) : Response
    {
        return $this -> dispatchNow( new StoreClientJob( $clientRequest ) );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
