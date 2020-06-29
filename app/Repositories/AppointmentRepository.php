<?php

namespace App\Repositories;

use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Jobs\StoreAppointmentJob;
use App\Jobs\UpdateAppointmentJob;
use App\Models\Appointment;
use App\Traits\Relatives;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    use Relatives;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function index()
    {
        return AppointmentResource::collection( Appointment::all() );
    }

    /**
     * @param AppointmentRequest $appointmentRequest
     * @return \Illuminate\Http\JsonResponse|mixed|object
     */
    public function store( AppointmentRequest $appointmentRequest )
    {
        return ( new StoreAppointmentJob( $appointmentRequest ) ) -> handle();
    }

    /**
     * @param Appointment $appointment
     * @return AppointmentResource|mixed
     */
    public function show( Appointment $appointment )
    {
        if ( $this -> loadRelationships() ) { $appointment -> load( $this -> relationships ); }
        return new AppointmentResource( $appointment );
    }

    /**
     * @param AppointmentRequest $appointmentRequest
     * @param Appointment $appointment
     * @return mixed|void
     */
    public function update( AppointmentRequest $appointmentRequest, Appointment $appointment )
    {
        return ( new UpdateAppointmentJob( $appointmentRequest, $appointment ) ) -> handle();
    }

    /**
     * @param Appointment $appointment
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy( Appointment $appointment )
    {
        try
        {
            $appointment -> delete();
            return response()->json('', 204);
        }

        catch ( \Exception $exception )
        {
            report($exception);
            return errorResponse();
        }
    }
}
