<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
    public function rules ()
    {
        return [
            'parent'            => [ 'nullable', 'integer', 'exists:categories' ],
            'name'              => [ 'required', 'max:50' ],
            'code'              => [ 'nullable', 'max:20' ],
            'short_description' => [ 'nullable', 'max:255' ],
            'aparat_video'      => [ 'nullable', 'url', 'size:30', 'starts_with:https://www.aparat.com/v/' ],
            'price'             => [ 'required', 'digits:10', 'min:0', 'integer' ],
            'unit'              => [ 'required', 'integer', 'in:0,1' ],
            'offer'             => [ 'nullable', 'integer', 'max:99', 'min:0' ],
            'offer_deadline'    => [ 'required', 'date_format:"Y-m-d H:i"' ],
            'colors'            => [ 'nullable', 'max:16777215' ],
            'label'             => [ 'nullable', 'in:1,2,3,4' ],
            "images"            => [ "nullable', 'array" ],
            "images.*"          => [ "image', 'mimes:jpeg,png,jpg', 'max:512', 'dimensions:ratio=1/1" ],
            "spec_table"        => [ 'nullable', 'integer', 'exists:specifications' ],
            "specs"             => [ 'nullable', 'array' ],
            "specs.*"           => [ 'nullable', 'array' ],
            "specs.*.*"         => [ 'nullable', 'string', 'max:50' ],
            'status'            => [ 'required', 'boolean' ],
            'stock_inventory'   => [ 'nullable', 'integer', 'min:0' ],
            'full_description'  => [ 'nullable' ],
            'keywords'          => [ 'nullable', 'max:16777215' ],   
            'advantages'        => [ 'nullable', 'max:16777215' ],
            'disadvantages'     => [ 'nullable', 'max:16777215' ],
        ];
    }

    public function messages ()
    {
        return [
            'aparat_video.url'      => 'لطفا آدرس url ویدیو ی مورد نظر خود از سایت آپارات را به درستی وارد کنید',
            'images.*.dimensions'   => 'تمامی عکس ها باید به صورت مربع (نسبت 1 به 1) باشند .',
        ];
    }
}
