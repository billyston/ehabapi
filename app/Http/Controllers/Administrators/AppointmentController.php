<?php

namespace App\Http\Controllers\SystemAdmins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Repositories\AppointmentRepositoryInterface;

class AppointmentController extends Controller
{
    private $theRepository;

    /**
     * AppointmentController constructor.
     * @param AppointmentRepositoryInterface $appointmentRepository
     */
    public function __construct ( AppointmentRepositoryInterface $appointmentRepository )
    {
        return $this -> theRepository = $appointmentRepository;
    }

    /**
     * @return mixed
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
        return $this -> theRepository -> store( $appointmentRequest );
    }

    /**
     * @param Appointment $appointment
     * @return mixed
     */
    public function show( Appointment $appointment )
    {
        return $this -> theRepository -> show( $appointment );
    }

    /**
     * @param AppointmentRequest $appointmentRequest
     * @param Appointment $appointment
     * @return mixed
     */
    public function update( AppointmentRequest $appointmentRequest, Appointment $appointment )
    {
        return $this -> theRepository -> update( $appointmentRequest, $appointment );
    }

    /**
     * @param Appointment $appointment
     * @return mixed
     */
    public function destroy( Appointment $appointment )
    {
        return $this -> theRepository -> destroy( $appointment );
    }
}
