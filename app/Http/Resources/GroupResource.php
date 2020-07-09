<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'type'                  => 'Group',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'name'              => $this -> name,
                'heading'           => $this -> heading,
                'client_message'    => $this -> client_message,
                'personnel_message' => $this -> personnel_message,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include' => $this -> when( $this -> relationLoaded( 'appointment' ) || $this -> relationLoaded( 'client' ),
            [
                'address'           => new AppointmentResource( $this -> whenLoaded( 'appointment' ) ),
                'client'            => ClientResource::collection( $this -> whenLoaded('client' ) ),
            ])
        ];
    }
}
