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

                'message_title'    => $this -> message_title,
                'client_message'    => $this -> client_message,
                'personnel_message' => $this -> personnel_message,

                'created_at'        => $this -> created_at -> diffForHumans(),
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
