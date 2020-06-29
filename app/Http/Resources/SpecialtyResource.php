<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialtyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'type' => 'Specialty',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'name'              => $this -> name,
                'known_as'          => $this -> known_as,
                'description'       => $this -> when( $this -> description, $this -> description ),

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include' => $this -> when( $this -> relationLoaded( 'hospital' ) || $this -> relationLoaded( 'service' ) || $this -> relationLoaded( 'personnel' ),
            [
                'hospital'          => new HospitalResource( $this -> whenLoaded('hospital' ) ),
                'service'           => ServiceResource::collection( $this -> whenLoaded('service') ),
                'personnel'         => PersonnelResource::collection( $this -> whenLoaded('personnel') ),
            ])
        ];
    }
}
