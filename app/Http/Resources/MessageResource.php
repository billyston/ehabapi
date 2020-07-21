<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray( $request )
    {
        return
        [
            'id'                    => $this -> id,
            'type'                  => 'Messages',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,

                'message_header'    => $this -> message_header,
                'client_message'    => $this -> client_message,
                'personnel_message' => $this -> personnel_message,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include' => $this -> when( $this -> relationLoaded( 'service' ) || $this -> relationLoaded( 'appointment' ),
            [
                'service'           => new ServiceResource( $this -> whenLoaded( 'service' ) ),
                'appointment'       => AppointmentResource::collection( $this -> whenLoaded('appointment') ),
            ])
        ];
    }
}
