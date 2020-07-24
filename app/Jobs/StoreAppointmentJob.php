<?php

namespace App\Jobs;

use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Traits\SMSNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreAppointmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SMSNotification;
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
        $appointment = new Appointment( $this -> theRequest [ 'data.attributes' ] );

        $appointment -> message()   -> associate( $this -> theRequest [ 'data.relationships.message.data.id' ] );
        $appointment -> client()    -> associate( $this -> theRequest [ 'data.relationships.client.data.id' ] );
        $appointment -> personnel() -> associate( $this -> theRequest [ 'data.relationships.personnel.data.id' ] );
        $appointment -> schedule()  -> associate( $this -> theRequest [ 'data.relationships.schedule.data.id' ] );

        $appointment -> save();

        // Send SMSNotification
        $this -> sendSMS( $appointment );

        // Return appointment resource
        return ( new AppointmentResource( $appointment ) ) -> response() -> setStatusCode(201 );
    }
}
