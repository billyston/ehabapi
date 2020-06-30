<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarRequest extends FormRequest
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
                'data.id'                                                           => [ 'required', 'string', 'exists:registrars,id' ],
                'data.type'                                                         => [ 'required', 'string', 'in:Registrar' ],
                'data.attributes.first_name'                                        => [ 'sometimes', 'string' ],
                'data.attributes.middle_name'                                       => [ 'sometimes', 'string' ],
                'data.attributes.last_name'                                         => [ 'sometimes', 'string' ],
                'data.attributes.gender'                                            => [ 'sometimes', 'string', 'in:male,female' ],
            ];
        }

        return
        [
            'data'                                                                  => [ 'required' ],
            'data.type'                                                             => [ 'required', 'string', 'in:Registrar' ],
            'data.attributes.first_name'                                            => [ 'required', 'string' ],
            'data.attributes.last_name'                                             => [ 'required', 'string' ],
            'data.attributes.gender'                                                => [ 'required', 'string', 'in:male,female' ],

            'data.attributes.email'                                                 => [ 'required', 'email', 'unique:registrars,email' ],
            'data.attributes.password'                                              => [ 'required', 'string', 'min:6', 'max:50' ],

            // Hospitals
            'data.relationships.hospital'                                           => [ 'required' ],
            'data.relationships.hospital.data'                                      => [ 'required' ],
            'data.relationships.hospital.data.*.id'                                 => [ 'required', 'exists:hospitals,id' ],
            'data.relationships.hospital.data.*.type'                               => [ 'required', 'in:Hospital' ],

            // Address
            'data.relationships.address.data.type'                                  => [ 'required', 'string', 'in:Address' ],
            'data.relationships.address.data.attributes.postal_code'                => [ 'required', 'string' ],
            'data.relationships.address.data.attributes.region'                     => [ 'required', 'string' ],
            'data.relationships.address.data.attributes.city'                       => [ 'required', 'string' ],
            'data.relationships.address.data.attributes.street_name'                => [ 'required', 'string' ],
            'data.relationships.address.data.attributes.house_number'               => [ 'string' ],

            // Country
            'data.relationships.address.data.relationships.country.data.type'       => [ 'required' ],
            'data.relationships.address.data.relationships.country.data.id'         => [ 'required', 'exists:countries,id' ],

            // Phone
            'data.relationships.phone.data.type'                                    => [ 'required', 'string', 'in:Phone' ],
            'data.relationships.phone.data.attributes.mobile_phone'                 => [ 'required', 'min:10', 'numeric' ],
            'data.relationships.phone.data.attributes.other_phone'                  => [ 'min:10', 'numeric' ],
        ];
    }
}
