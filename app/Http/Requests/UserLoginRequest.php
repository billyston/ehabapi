<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
        return
        [
            'data'                      => [ 'required', 'array' ],
            'data.type'                 => [ 'required', 'in:SystemAdmin,Administrator,Registrar,Personnel,Client' ],
            'data.attributes.email'     => [ 'required', 'email' ],
            'data.attributes.password'  => [ 'required', 'string', 'min:6', 'max:50' ]
        ];
    }
}
