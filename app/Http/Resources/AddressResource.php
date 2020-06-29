<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'type'                  => 'Address',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'region'            => $this -> region,
                'city'              => $this -> city,
                'street_name'       => $this -> street_name,
                'postal_code'       => $this -> postal_code,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),

                'country'           => $this -> country,
            ]
        ];
    }
}
