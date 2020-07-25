<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SMSNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray( $request )
    {
        return
        [
            'id'                    => $this -> id,
            'type'                  => 'SMSNotification',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,

                'appointment_date'  => $this -> appointment_date,
                'appointment_time'  => $this -> appointment_time,
                'created_at'        => $this -> created_at -> toDateTimeString(),

                'client'            => $this -> client      -> load( 'phone' ),
                'personnel'         => $this -> personnel   -> load( 'phone' ),
                'message'           => $this -> message     -> only( 'message_title', 'client_message', 'personnel_message' ),
                'schedule'          => $this -> schedule    -> only( 'starts_at', 'ends_at' ),
            ],
        ];
    }
}
