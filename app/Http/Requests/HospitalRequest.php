<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
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
                'data.id'                                                           => [ 'required', 'string', 'exists:hospitals,id' ],
                'data.type'                                                         => [ 'required', 'string', 'in:Hospital' ],
                'data.attributes.name'                                              => [ 'sometimes', 'string', 'min:6', 'unique:hospitals,name,' . $this -> route('hospital' ) -> id ],
                'data.attributes.known_as'                                          => [ 'sometimes', 'string', 'min:3', 'unique:hospitals,known_as,' . $this -> route('hospital' ) -> id ],
                'data.attributes.about'                                             => [ 'nullable', 'string', 'min:10' ],
                'data.attributes.email'                                             => [ 'sometimes', 'email', 'unique:hospitals,email,' . $this -> route('hospital') -> id ],
                'data.attributes.website'                                           => [ 'nullable', 'url', 'min:100' ],
            ];
        }

        return
        [
            'data'                                                                  => [ 'required' ],
            'data.type'                                                             => [ 'required', 'string', 'in:Hospital' ],
            'data.attributes.name'                                                  => [ 'required', 'string', 'min:6', 'unique:hospitals,name' ],
            'data.attributes.known_as'                                              => [ 'required', 'string', 'min:3', 'unique:hospitals,known_as' ],
            'data.attributes.website'                                               => [ 'nullable', 'url', 'min:4' ],
            'data.attributes.email'                                                 => [ 'email', 'unique:hospitals,email' ],
            'data.attributes.about'                                                 => [ 'nullable', 'min:100' ],

            // Address
            'data.relationships.address.data.type'                                  => [ 'required', 'string', 'in:Address' ],
            'data.relationships.address.data.attributes.postal_code'                => [ 'required', 'string' ],
            'data.relationships.address.data.attributes.region'                     => [ 'required', 'string' ],
            'data.relationships.address.data.attributes.city'                       => [ 'required', 'string' ],
            'data.relationships.address.data.attributes.street_name'                => [ 'required', 'string' ],
            'data.relationships.address.data.attributes.house_number'               => [ 'string' ],

            // Country
            'data.relationships.address.data.relationships.country'                 => [ 'required' ],
            'data.relationships.address.data.relationships.country.data.type'       => [ 'required' ],
            'data.relationships.address.data.relationships.country.data.id'         => [ 'required', 'exists:countries,id' ],

            // Phone
            'data.relationships.phone.data.type'                                    => [ 'required', 'string', 'in:Phone' ],
            'data.relationships.phone.data.attributes.mobile_phone'                 => [ 'required', 'min:10', 'numeric' ],
            'data.relationships.phone.data.attributes.other_phone'                  => [ 'min:10', 'numeric' ],
        ];
    }
}
