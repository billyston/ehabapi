<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SystemAdminResource extends JsonResource
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
            'type'                  => 'System',

            'attributes' =>
            [
                'smart_id'          => $this -> smart_id,
                'first_name'        => $this -> first_name,
                'middle_name'       => $this -> middle_name,
                'last_name'         => $this -> last_name,
                'gender'            => $this -> gender,

                'department'        => $this -> department,
                'position'          => $this -> position,

                'email'             => $this -> email,
                'status'            => $this -> status,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ]
        ];
    }
}
