<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NextOfKinRequest extends FormRequest
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
        return
        [
            'data.relationships.next-of-kin'                                        => [ 'required' ],
            'data.relationships.next-of-kin.data.type'                              => [ 'required', 'string', 'in:NextOfKin' ],
            'data.relationships.next-of-kin.data.attributes.first_name'             => [ 'required', 'string' ],
            'data.relationships.next-of-kin.data.attributes.middle_name'            => [ 'sometimes', 'string' ],
            'data.relationships.next-of-kin.data.attributes.last_name'              => [ 'required', 'string' ],
            'data.relationships.next-of-kin.data.attributes.gender'                 => [ 'required', 'string', 'in:male,female' ],
            'data.relationships.next-of-kin.data.attributes.relation'               => [ 'required', 'string' ],
            'data.relationships.next-of-kin.data.attributes.mobile_phone'           => [ 'required', 'min:10', 'numeric' ],
            'data.relationships.next-of-kin.data.attributes.other_phone'            => [ 'min:10', 'numeric' ],
        ];
    }
}
