<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
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
            'state'             => [ 'required', 'string', 'max:30' ],
            'city'              => [ 'required', 'string', 'max:20' ],
            'address'           => [ 'required', 'string', 'max:200' ],
            'buyer_description' => [ 'nullable', 'string', 'max:255' ],
            'shipping_type'     => [ 'required', 'in:model1,model2,model3,model4' ],
            'postal_code'       => [ 'required', 'integer', 'digits:10' ],
        ];
    }
}
