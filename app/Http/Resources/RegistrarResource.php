<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrarResource extends JsonResource
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
            'id'                    => $this -> id,
            'type'                  => 'Registrar',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'first_name'        => $this -> first_name,
                'middle_name'       => $this -> middle_name,
                'last_name'         => $this -> last_name,
                'gender'            => $this -> gender,
                'email'             => $this -> email,
                'status'            => $this -> status,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include' => $this -> when( $this -> relationLoaded( 'hospital' ) || $this -> relationLoaded( 'address' ) || $this -> relationLoaded( 'phone' ),
            [
                'hospital'      => HospitalResource::collection( $this -> whenLoaded('hospital') ),
                'address'       => new AddressResource( $this -> whenLoaded( 'address' ) ),
                'phone'         => new PhoneResource( $this -> whenLoaded( 'phone' ) ),
            ])
        ];
    }
}
