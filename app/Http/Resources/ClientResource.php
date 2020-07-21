<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'type'                  => 'Client',

            'attributes' =>
            [
                'title'             => $this -> title,
                'smart_id'          => $this -> smart_id,
                'first_name'        => $this -> first_name,
                'middle_name'       => $this -> middle_name,
                'last_name'         => $this -> last_name,
                'gender'            => $this -> gender,
                'email'             => $this -> email,
                'date_of_birth'     => $this -> date_of_birth,

                'occupation'        => $this -> occupation,
                'nationality'       => $this -> nationality,


                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include' => $this -> when( $this -> relationLoaded( 'address' ) || $this -> relationLoaded( 'phone' ) || $this -> relationLoaded( 'hospital' ) || $this -> relationLoaded( 'next_of_kin' ),
            [
                'address'           => new AddressResource( $this -> whenLoaded( 'address' ) ),
                'phone'             => new PhoneResource( $this -> whenLoaded( 'phone' ) ),
                'next_of_kin'       => new NextOfKinResource( $this -> whenLoaded( 'next_of_kin' ) ),
                'hospital'          => HospitalResource::collection( $this->whenLoaded('hospital') ),
            ])
        ];
    }
}
