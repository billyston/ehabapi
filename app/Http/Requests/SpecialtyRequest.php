<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtyRequest extends FormRequest
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
                'data.id'                                                           => [ 'required', 'string', 'exists:specialties,id' ],
                'data.type'                                                         => [ 'required', 'string', 'in:Specialty' ],
                'data.attributes.name'                                              => [ 'sometimes', 'string' ],
                'data.attributes.known_as'                                          => [ 'sometimes', 'string' ],
                'data.attributes.description'                                       => [ 'sometimes', 'string', 'min:50' ],
            ];
        }

        return
        [
            'data'                                                                  => [ 'required' ],
            'data.type'                                                             => [ 'required', 'string', 'in:Specialty' ],
            'data.attributes.name'                                                  => [ 'required', 'string' ],
            'data.attributes.known_as'                                              => [ 'required', 'string' ],
            'data.attributes.description'                                           => [ 'nullable', 'min:50' ],

            'data.relationships.hospital'                                           => [ 'required' ],
            'data.relationships.hospital.type'                                      => [ 'required', 'in:Hospital' ],
            'data.relationships.hospital.id'                                        => [ 'required', 'exists:hospitals,id' ],
        ];
    }
}
