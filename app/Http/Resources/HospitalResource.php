<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HospitalResource extends JsonResource
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
            'type'                  => 'Hospital',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'name'              => $this -> name,
                'known_as'          => $this -> known_as,
                'email'             => $this -> email,
                'website'           => $this -> website,
                'about'             => $this -> about,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include' => $this -> when( $this -> relationLoaded( 'administrator' ) || $this -> relationLoaded( 'specialty' ) || $this -> relationLoaded( 'personnel' ) || $this -> relationLoaded( 'client' ) || $this -> relationLoaded( 'address' ) || $this -> relationLoaded( 'phone' ),
            [
                'administrator'     => AdministratorResource::collection( $this -> whenLoaded('administrator' ) ),
                'specialty'         => ScheduleResource::collection( $this -> whenLoaded('specialty' ) ),
                'personnel'         => PersonnelResource::collection( $this -> whenLoaded('personnel' ) ),
                'client'            => ClientResource::collection( $this -> whenLoaded('client' ) ),
                'address'           => new AddressResource( $this -> whenLoaded( 'address' ) ),
                'phone'             => new PhoneResource( $this -> whenLoaded( 'phone' ) ),
            ])
        ];
    }
}
