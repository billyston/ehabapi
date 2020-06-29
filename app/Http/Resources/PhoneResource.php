<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhoneResource extends JsonResource
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
            'type'                  => 'Phone',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'mobile_phone'      => $this -> mobile_phone,
                'other_phone'       => $this -> other_phone,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ]
        ];
    }
}
