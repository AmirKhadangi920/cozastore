<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
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
            'parent' => 'nullable|integer',
            'name' => 'required|min:6|max:50',
            'code' => 'nullable|max:20',
            'short_description' => 'nullable|max:255',
            'aparat_video' => 'nullable|url',
            'price' => 'required|integer',
            'unit' => 'required|integer',
            'offer' => 'nullable|integer',
            'colors' => 'nullable',
            "photo"    => "required|max:15",
            "features" => 'nullable',
            "featuers.*.name" => 'nullable|integer',
            "features.*.value" => 'nullable|max:50',
            'status' => 'required|boolean',
            'full_description' => 'nullable',
            'keywords' => 'nullable',
            'advantages' => 'nullable',
            'disadvantages' => 'nullable',
        ];
    }

    public function messages ()
    {
        return [
            'parent.integer' => 'دستکاری در اطلاعات ارسالی تشخیص داده شده است ، لطفا دوباره تلاش کنید .test',
            'name.required' => 'وارد کردن نام محصول اجباری است !',
            'name.min' => 'نام محصول میبایست حداعقل 6 کاراکتر باشد !',
            'name.max' => 'نام محصول میبایست حداکثر 50 کاراکتر باشد !',
            'code.max' => 'کد محصول میبایست حداکثر 20 کاراکتر باشد !',
            'aparat_video.url' => 'لطفا آدرس url ویدیو ی مورد نظر خود از سایت آپارات را به درستی وارد کنید',
            // 'aparat_video.regex' => 'لطفا آدرس ویدیوی خود را بر روی وبسایت آپارات وارد کنید !',
            'short_description.max' => 'توضیح کوتاه محصول میبایست حداکثر 255 کاراکتر باشد !',
            'price.required' => 'وارد کردن قیمت محصول اجباری است !',
            'price.integer' => 'قیمت محصول میبایست به صورت عددی باشد',
            'photo.required' => 'میبایست حداقل یک عکس برای محصول انتخاب کنید !',
            'photo.max' => 'دستکاری در اطلاعات ارسالی تشخیص داده شده است ، لطفا دوباره تلاش کنید .',
            "features.*.name.integer" => 'دستکاری در اطلاعات ارسالی تشخیص داده شده است ، لطفا دوباره تلاش کنید .',
            "features.*.value.max" => 'مقدار یک ویژگی میبایست حداکثر 50 کاراکتر باشد !',
            'unit.required' => 'وارد کردن واحد پولی محصول اجباری است !',
            'unit.integer' => 'دستکاری در اطلاعات ارسالی تشخیص داده شده است ، لطفا دوباره تلاش کنید .',
            'offer.integer' => 'تخفیف محصول میباسد به صورت عددی باشد !',
            'status.boolean' => 'دستکاری در اطلاعات ارسالی تشخیص داده شده است ، لطفا دوباره تلاش کنید .',
        ];
    }
}
