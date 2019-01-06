<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecRowRequest extends FormRequest
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
        return [
            'title'     => [ 'required', 'max:50' ],
            'label'     => [ 'nullable', 'max:50' ],
            'values'    => [ 'nullable' ],
            'help'    => [ 'nullable', 'string' ],
            'multiple'  => [ 'required', 'boolean' ]
        ];
    }
}
