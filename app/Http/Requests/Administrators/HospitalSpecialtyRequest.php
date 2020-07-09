<?php

namespace App\Http\Requests\Administrators;

use Illuminate\Foundation\Http\FormRequest;

class HospitalSpecialtyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ( in_array( $this.$this->getMethod(), [ 'PUT', 'PATCH' ] ) )
        {
            return ( $this -> route( 'hospital' ) -> id === $this -> route( 'specialty' ) -> hospital_id ) === auth( 'jwt' ) -> user() -> hospitals -> contains( $this -> route( 'hospital' ) );
        }
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
                'data.attributes.name'                                              => [ 'sometimes', 'string', 'min:5', 'unique:specialties,name' ],
                'data.attributes.known_as'                                          => [ 'sometimes', 'string', 'min:5', 'unique:specialties,known_as' ],
                'data.attributes.description'                                       => [ 'sometimes', 'string', 'min:50' ],
            ];
        }

        return
        [
            'data'                                                                  => [ 'required' ],
            'data.type'                                                             => [ 'required', 'in:Specialty' ],
            'data.attributes.name'                                                  => [ 'required', 'min:5', 'unique:specialties,name' ],
            'data.attributes.known_as'                                              => [ 'required', 'min:5', 'unique:specialties,known_as' ],
            'data.attributes.description'                                           => [ 'nullable', 'min:10' ],
        ];
    }
}
