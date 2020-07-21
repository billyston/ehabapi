<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
                'data.id'                                                           => [ 'required', 'string', 'exists:messages,id' ],
                'data.type'                                                         => [ 'required', 'string', 'in:Message' ],
                'data.attributes.message_header'                                    => [ 'sometime', 'string' ],
                'data.attributes.client_message'                                    => [ 'sometime', 'string' ],
                'data.attributes.personnel_message'                                 => [ 'sometime', 'string' ],
            ];
        }

        return
        [
            'data'                                                                  => [ 'required' ],
            'data.type'                                                             => [ 'required', 'string', 'in:Message' ],
            'data.attributes.message_header'                                        => [ 'required', 'string' ],
            'data.attributes.client_message'                                        => [ 'required', 'string' ],
            'data.attributes.personnel_message'                                     => [ 'required', 'string' ],

            // Service
            'data.relationships.service'                                            => [ 'required' ],
            'data.relationships.service.data.type'                                  => [ 'required', 'string', 'in:Service' ],
            'data.relationships.service.data.id'                                    => [ 'required', 'exists:services,id' ],
        ];
    }
}
