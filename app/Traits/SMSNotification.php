<?php

namespace App\Traits;

use App\Http\Resources\SMSNotificationResource;
use Illuminate\Support\Facades\Http;

trait SMSNotification
{
    /**
     * @param $from
     * @param $to
     * @param $message
     * @return \Illuminate\Http\Client\Response
     */
    public function performSendSMS( $from, $to, $message )
    {
        $response = Http::withBasicAuth('fbylqrgr', 'xlilsenv' ) -> post( 'https://api.hubtel.com/v1/messages', [ 'From' => $from, 'To' => $to, 'registeredDelivery' => true, 'Content' => $message ] );
        return $response;
    }

    public function sendSMS( $appointment )
    {
        // Get the appointment resource
        $data = new SMSNotificationResource( $appointment );

        // Prepare the message data
        $from       = 'RIDGEHCS';
        $to = $data -> client -> phone -> mobile_phone;
        $message = $data -> message -> client_message;
        $date = $data -> appointment_date;
        $time = $data -> appointment_time;

        // Format the date
        $date = date( 'l jS F Y', strtotime($date));

        // Replace the date and time in the message
        $message = str_replace("date", $date, $message );
        $message = str_replace("time", $time, $message );

        // Send the message
        $this -> performSendSMS( $from, $to, $message );
    }
}
