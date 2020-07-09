<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Jobs\StoreGroupJob;
use App\Repositories\Administrators\HospitalGroupRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HospitalGroupController extends Controller
{
    private $theRepository;

    /**
     * HospitalGroupController constructor.
     * @param HospitalGroupRepositoryInterface $hospitalGroupRepository
     */
    public function __construct( HospitalGroupRepositoryInterface $hospitalGroupRepository )
    {
        $this -> theRepository = $hospitalGroupRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param GroupRequest $groupRequest
     * @return Response
     */
    public function store( GroupRequest $groupRequest ) : Response
    {
        return $this -> dispatchNow( new StoreGroupJob( $groupRequest ) );
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
