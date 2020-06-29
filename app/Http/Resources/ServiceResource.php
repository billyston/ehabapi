<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray( $request )
    {
        return
        [
            'id' => $this -> id,
            'type' => 'Service',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'name'              => $this -> name,
                'known_as'          => $this -> known_as,
                'description'       => $this -> when( $this -> description, $this -> description ),

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include' => $this -> when( $this -> relationLoaded( 'specialty' ),
            [
                'specialty' => new SpecialtyResource( $this -> whenLoaded('specialty' ) )
            ])
        ];
    }
}
