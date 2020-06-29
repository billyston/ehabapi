<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        if ( in_array( $this -> getMethod (), [ 'PUT', 'PATCH' ] ) )
        {
            return $rules =
            [
                'data'                                                              => [ 'required' ],
                'data.id'                                                           => [ 'required', 'string', 'exists:schedules,id' ],
                'data.type'                                                         => [ 'required', 'string', 'in:Schedule' ],
                'data.attributes.starts_at'                                         => [ 'sometimes' ],
                'data.attributes.ends_at'                                           => [ 'sometimes' ],
            ];
        }

        return
        [
            'data'                                                                  => [ 'required' ],
            'data.type'                                                             => [ 'required', 'string', 'in:Schedule' ],
            'data.attributes.starts_at'                                             => [ 'required' ],
            'data.attributes.ends_at'                                               => [ 'required' ],
        ];
    }
}
