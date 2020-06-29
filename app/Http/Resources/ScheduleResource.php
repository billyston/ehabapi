<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'type'                  => 'Schedule',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'starts_at'         => $this -> starts_at,
                'ends_at'           => $this -> ends_at,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include' => $this -> when( $this -> relationLoaded( 'personnel' ),
            [
                'personnel' => PersonnelResource::collection( $this -> whenLoaded('personnel' ) )
            ])
        ];
    }
}
