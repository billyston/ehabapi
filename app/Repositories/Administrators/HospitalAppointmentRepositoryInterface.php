<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Hospital;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface HospitalAppointmentRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection;

    /**
     * @param Hospital $hospital
     * @param Appointment $appointment
     * @return AppointmentResource
     */
    public function show( Hospital $hospital, Appointment $appointment ): AppointmentResource;
}
