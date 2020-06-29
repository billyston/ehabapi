<?php

namespace App\Repositories;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;

interface AppointmentRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param AppointmentRequest $appointmentRequest
     * @return mixed
     */
    public function store( AppointmentRequest $appointmentRequest );

    /**
     * @param Appointment $appointment
     * @return mixed
     */
    public function show( Appointment $appointment );

    /**
     * @param AppointmentRequest $appointmentRequest
     * @param Appointment $appointment
     * @return mixed
     */
    public function update( AppointmentRequest $appointmentRequest, Appointment $appointment );

    /**
     * @param Appointment $appointment
     * @return mixed
     */
    public function destroy( Appointment $appointment );
}
