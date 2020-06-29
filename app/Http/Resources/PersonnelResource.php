<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelResource extends JsonResource
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
            'type'                  => 'Personnel',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'first_name'        => $this -> first_name,
                'middle_name'       => $this -> middle_name,
                'last_name'         => $this -> last_name,
                'gender'            => $this -> gender,
                'email'             => $this -> email,
                'status'            => $this -> status,

                'role'              => $this -> role,

                'facebook'          => $this -> facebook,
                'twitter'           => $this -> twitter,
                'linkedin'          => $this -> linkedin,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include' => $this -> when( $this -> relationLoaded( 'address' ) || $this -> relationLoaded( 'phone' ) || $this -> relationLoaded( 'hospital' ) || $this -> relationLoaded( 'specialty' ) || $this -> relationLoaded( 'service' ) || $this -> relationLoaded( 'schedule' ) || $this -> relationLoaded( 'appointment' ),
            [
                'address'           => new AddressResource( $this -> whenLoaded( 'address' ) ),
                'phone'             => new PhoneResource( $this -> whenLoaded( 'phone' ) ),

                'appointment'       => new AppointmentResource( $this -> whenLoaded( 'appointment' ) ),
                'hospital'          => HospitalResource::collection( $this -> whenLoaded('hospital') ),
                'specialty'         => new SpecialtyResource( $this -> whenLoaded( 'specialty' ) ),
                'service'           => ServiceResource::collection( $this -> whenLoaded('service') ),
                'schedule'          => ScheduleResource::collection( $this -> whenLoaded('schedule') ),
            ])
        ];
    }
}
