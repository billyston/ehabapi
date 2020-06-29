<?php

namespace App\Http\Controllers\SystemAdmins;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonnelRequest;
use App\Models\Personnel;
use App\Repositories\PersonnelRepositoryInterface;

class PersonnelController extends Controller
{
    private $theRepository;

    /**
     * PersonnelController constructor.
     * @param PersonnelRepositoryInterface $personnelRepository
     */
    public function __construct ( PersonnelRepositoryInterface $personnelRepository )
    {
        $this -> theRepository = $personnelRepository;
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
     * @param PersonnelRequest $personnelRequest
     * @return mixed
     */
    public function store( PersonnelRequest $personnelRequest )
    {
        return $this -> theRepository -> store( $personnelRequest );
    }

    /**
     * @param Personnel $personnel
     * @return mixed
     */
    public function show( Personnel $personnel )
    {
        return $this -> theRepository -> show( $personnel );
    }

    /**
     * @param PersonnelRequest $personnelRequest
     * @param Personnel $personnel
     * @return mixed
     */
    public function update( PersonnelRequest $personnelRequest, Personnel $personnel )
    {
        return $this -> theRepository -> update( $personnelRequest, $personnel );
    }

    /**
     * @param Personnel $personnel
     * @return mixed
     */
    public function destroy( Personnel $personnel )
    {
        return $this -> theRepository -> destroy( $personnel );
    }
}
