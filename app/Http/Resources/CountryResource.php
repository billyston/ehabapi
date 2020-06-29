<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'types'                 => 'Country',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'name'              => $this -> resource -> name,
                'iso_code'          => $this -> resource -> iso_code,
                'phone_code'        => $this -> resource -> phone_code,
                'currency'          => $this -> resource -> currency,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include' => $this -> when( $this -> relationLoaded( 'addresses' ), function ()
            {
                return
                [
                    'addresses' => AddressResource::collection( $this -> whenLoaded('addresses') ),
                ];
            })

        ];
    }
}
