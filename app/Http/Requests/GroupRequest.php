<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ( in_array( $this -> getMethod (), [ 'PUT', 'PATCH' ] ) )
        {
            return $rules =
            [
                'data'                                                              => [ 'required' ],
                'data.type'                                                         => [ 'required', 'string', 'in:Group' ],
                'data.id'                                                           => [ 'required', 'string', 'exists:groups,id' ],

                'data.attributes.name'                                              => [ 'sometimes', 'string' ],
                'data.attributes.heading'                                           => [ 'sometimes', 'string' ],
                'data.attributes.client_message'                                    => [ 'sometimes', 'string' ],
                'data.attributes.personnel_message'                                 => [ 'sometimes', 'string' ]
            ];
        }

        return
        [
            'data'                                                                  => [ 'required' ],
            'data.type'                                                             => [ 'required', 'string', 'in:Group' ],

            'data.attributes.name'                                                  => [ 'required', 'string' ],
            'data.attributes.heading'                                               => [ 'sometimes', 'string' ],
            'data.attributes.client_message'                                        => [ 'required', 'string' ],
            'data.attributes.personnel_message'                                     => [ 'required', 'string' ]
        ];
    }
}
