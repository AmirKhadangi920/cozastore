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
        $rules = [
            'name'                       => [ 'required', 'max:50' ],
            'code'                       => [ 'nullable', 'max:20' ],
            'short_description'          => [ 'nullable', 'max:255' ],
            'parent'                     => [ 'nullable', 'integer', 'exists:categories,id' ],
            'aparat_video'               => [ 'nullable', 'url', 'size:30' ],
            'brand'                      => [ 'nullable', 'integer', 'exists:brands,id' ],
            'label'                      => [ 'nullable', 'in:1,2,3,4' ],
            'status'                     => [ 'required', 'boolean' ],
            'full_description'           => [ 'nullable' ],
            'keywords'                   => [ 'nullable', 'max:16777215' ],
            'note'                       => [ 'nullable', 'max:16777215' ],
            'images'                     => [ 'nullable', 'array' ],
            'images.*'                   => [ 'image', 'mimes:jpeg,png,jpg', 'max:512', 'dimensions:ratio=1/1' ],
            'deleted_images'             => [ 'nullable', 'json' ],
            'advantages'                 => [ 'nullable', 'max:16777215' ],
            'disadvantages'              => [ 'nullable', 'max:16777215' ],
            "specs"                      => [ 'nullable', 'array' ],
            "specs.*"                    => [ 'nullable', 'array' ],
            "specs.*.id"                 => [ 'nullable', 'integer' ],
            "specs.*.data"               => [ 'nullable' ],
            'variations'                 => [ 'nullable', 'array' ],
            'variations.*'               => [ 'nullable', 'array' ],
            'variations.*.id'            => [ 'nullable', 'exists:product_variations,id', 'integer' ],
            'variations.*.price'         => [ 'nullable', 'digits_between:1,10', 'min:0', 'integer' ],
            'variations.*.unit'          => [ 'required', 'integer', 'in:0,1' ],
            'variations.*.offer'         => [ 'nullable', 'digits_between:1,10', 'min:0', 'integer' ],
            'variations.*.offer_deadline'=> [ 'nullable', 'date' ],
            'variations.*.stock_inventory'=>[ 'nullable', 'integer', 'min:0' ],
            'variations.*.color'         => [ 'nullable', 'integer', 'exists:colors,id' ],
            'variations.*.warranty'      => [ 'nullable', 'integer', 'exists:warranties,id' ],
        ];

        if ( request()->method() == 'POST' )
        {
            $rules['images'] = [ 'required', 'array', 'min:1' ];
            $rules['variations'] = [ 'required', 'array', 'min:1' ];
            $rules['variations.*.price'][0] = 'required';
        }
        return $rules;
    }

    public function messages ()
    {
        return [
            'aparat_video.url'      => 'لطفا آدرس url ویدیو ی مورد نظر خود از سایت آپارات را به درستی وارد کنید',
            'images.*.dimensions'   => 'تمامی عکس ها باید به صورت مربع (نسبت 1 به 1) باشند .',
        ];
    }

    public function attributes()
    {
        return [
            'name'                       => 'نام محصول',
            'code'                       => 'کد محصول',
            'short_description'          => 'توضیح کوتاه',
            'parent'                     => 'گروه',
            'aparat_video'               => 'ویديوی آپارات',
            'brand'                      => 'برند',
            'label'                      => 'لیبل',
            'status'                     => 'وضعیت',
            'full_description'           => 'توضیح کامل',
            'keywords'                   => 'کلمات کلیدی',
            'note'                       => 'یادداشت',
            'images'                     => 'عکس های محصول',
            'images.*'                   => 'عکس های محصول',
            'deleted_images'             => 'عکس های پاک شده',
            'advantages'                 => 'مزایای محصول',
            'disadvantages'              => 'معایب محصول',
            "specs"                      => 'جدول مشخصات',
            "specs.*"                    => 'اطلاعات جدول مشخصات',
            "specs.*.id"                 => 'ID جدول مشخصات',
            "specs.*.data"               => 'اطلاعات جدول مشخصات',
            'variations'                 => 'تنوع های محصول', 
            'variations.*'               => 'تنوع های محصول', 
            'variations.*.id'            => 'ID تنوع محصول',
            'variations.*.price'         => 'قیمت محصول',
            'variations.*.unit'          => 'واحد پولی',
            'variations.*.offer'         => 'تخفیف',
            'variations.*.offer_deadline'=> 'انقضای تخفیف',
            'variations.*.stock_inventory'=>'موجودی انبار',
            'variations.*.color'         => 'رنگ',
            'variations.*.warranty'      => 'گارانتی',
        ];
    }
}
