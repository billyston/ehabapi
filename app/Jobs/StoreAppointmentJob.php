<?php

namespace App\Jobs;

use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreAppointmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * StoreAppointmentJob constructor.
     * @param AppointmentRequest $appointmentRequest
     */
    public function __construct( AppointmentRequest $appointmentRequest )
    {
        $this -> theRequest = $appointmentRequest;
    }

    /**
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function handle()
    {
        $Appointment = new Appointment( $this -> theRequest [ 'data.attributes' ] );

        $Appointment -> message()   -> associate( $this -> theRequest [ 'data.relationships.message.data.id' ] );
        $Appointment -> client()    -> associate( $this -> theRequest [ 'data.relationships.client.data.id' ] );
        $Appointment -> personnel() -> associate( $this -> theRequest [ 'data.relationships.personnel.data.id' ] );
        $Appointment -> schedule()  -> associate( $this -> theRequest [ 'data.relationships.schedule.data.id' ] );

        $Appointment -> save();

        // Send SMS

        // Return appointment resource
        return ( new AppointmentResource( $Appointment ) ) -> response() -> setStatusCode(201 );
    }
}
