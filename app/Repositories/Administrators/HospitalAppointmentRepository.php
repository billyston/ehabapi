<?php

namespace App\Repositories\Administrators;

use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Hospital;
use App\Traits\Relatives;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HospitalAppointmentRepository implements HospitalAppointmentRepositoryInterface
{
    use Relatives;

    /**
     * @return AnonymousResourceCollection
     */
    public function index (): AnonymousResourceCollection
    {
        return AppointmentResource::collection( Appointment::query() -> paginate( 20 ) );
    }

    /**
     * @param Hospital $hospital
     * @param Appointment $appointment
     * @return AppointmentResource
     */
    public function show( Hospital $hospital, Appointment $appointment ) : AppointmentResource
    {
        if ( $this -> loadRelationships() ) { $appointment -> load( $this -> relationships ); }
        return new AppointmentResource( $appointment );
    }
}
