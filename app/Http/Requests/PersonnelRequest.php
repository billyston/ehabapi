<?php

namespace App\Http\Requests;

use App\Models\Personnel;
use Illuminate\Foundation\Http\FormRequest;

class PersonnelRequest extends FormRequest
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
                'data.id'                                                           => [ 'required', 'string', 'exists:personnels,id' ],
                'data.type'                                                         => [ 'required', 'string', 'in:Personnel' ],

                'data.attributes.first_name'                                        => [ 'sometimes', 'string' ],
                'data.attributes.middle_name'                                       => [ 'sometimes', 'string' ],
                'data.attributes.last_name'                                         => [ 'sometimes', 'string' ],
                'data.attributes.gender'                                            => [ 'sometimes', 'string', 'in:male,female' ],

                'data.attributes.role'                                              => [ 'sometimes', 'string', 'in:'.implode(',', Personnel::ROLES ) ],

                'data.attributes.facebook'                                          => [ 'sometimes', 'url', ],
                'data.attributes.twitter'                                           => [ 'sometimes', 'url', ],
                'data.attributes.linkedin'                                          => [ 'sometimes', 'url', ],
            ];
        }

        return
        [
            'data'                                                                  => [ 'required' ],
            'data.type'                                                             => [ 'required', 'string', 'in:Personnel' ],
            'data.attributes.first_name'                                            => [ 'required', 'string' ],
            'data.attributes.last_name'                                             => [ 'required', 'string' ],
            'data.attributes.gender'                                                => [ 'required', 'string', 'in:male,female' ],
            'data.attributes.role'                                                  => [ 'sometimes', 'string', 'in:'.implode(',', Personnel::ROLES ) ],

            'data.attributes.email'                                                 => [ 'required', 'email', 'unique:personnels,email' ],
            'data.attributes.password'                                              => [ 'required', 'min:6' ],

            // Hospitals
            'data.relationships.hospital'                                           => [ 'required' ],
            'data.relationships.hospital.data'                                      => [ 'required' ],
            'data.relationships.hospital.data.*.id'                                 => [ 'required', 'exists:hospitals,id' ],
            'data.relationships.hospital.data.*.type'                               => [ 'required', 'in:Hospital' ],

            // Specialty
            'data.relationships.specialty'                                          => [ 'required' ],
            'data.relationships.specialty.data.type'                                => [ 'required', 'in:Specialty' ],
            'data.relationships.specialty.data.id'                                  => [ 'required', 'exists:specialties,id' ],

            // Service
            'data.relationships.service'                                            => [ 'required' ],
            'data.relationships.service.data'                                       => [ 'required' ],
            'data.relationships.service.data.*.id'                                  => [ 'required', 'exists:services,id' ],
            'data.relationships.service.data.*.type'                                => [ 'required', 'in:Service' ],

            // Schedule
            'data.relationships.schedule'                                            => [ 'required' ],
            'data.relationships.schedule.data'                                       => [ 'required' ],
            'data.relationships.schedule.data.*.id'                                  => [ 'required', 'exists:schedules,id' ],
            'data.relationships.schedule.data.*.type'                                => [ 'required', 'in:Schedule' ],

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
