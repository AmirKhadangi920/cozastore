<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'title'         => [ 'required', 'max:50' ], 
            'parent'        => [ 'nullable', 'integer' ],
            'description'   => [ 'nullable', 'max:255' ],
            'avatar'        => [ 'required', 'max:512', 'image', 'mimes:jpeg,jpg,png' ]
        ];
        if (request()->isMethod('put')) 
        {
            $rules['avatar'][0] = 'nullable';
        }

        return $rules;
    }
}
