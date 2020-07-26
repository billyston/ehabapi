<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Jobs\StoreAppointmentJob;
use App\Models\Appointment;
use App\Models\Hospital;
use App\Repositories\Administrators\HospitalAppointmentRepositoryInterface;
use Illuminate\Http\Request;

class HospitalAppointmentController extends Controller
{
    private $theRepository;

    /**
     * HospitalAppointmentController constructor.
     * @param HospitalAppointmentRepositoryInterface $hospitalAppointmentRepository
     */
    public function __construct( HospitalAppointmentRepositoryInterface $hospitalAppointmentRepository )
    {
        $this -> theRepository = $hospitalAppointmentRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param AppointmentRequest $appointmentRequest
     * @return mixed
     */
    public function store( AppointmentRequest $appointmentRequest )
    {
        return $this -> dispatchNow( new StoreAppointmentJob( $appointmentRequest ) );
    }

    /**
     * @param Hospital $hospital
     * @param Appointment $appointment
     * @return AppointmentResource
     */
    public function show( Hospital $hospital, Appointment $appointment ): AppointmentResource
    {
        return $this -> theRepository -> show( $hospital, $appointment );
    }

    /**
     * @param AppointmentRequest $appointmentRequest
     * @param Appointment $appointment
     */
    public function update( AppointmentRequest $appointmentRequest, Appointment $appointment )
    {
        //
    }

    /**
     * @param Appointment $appointment
     */
    public function destroy( Appointment $appointment )
    {
        //
    }
}
