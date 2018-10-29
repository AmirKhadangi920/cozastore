<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFeature extends FormRequest
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
            'name' => 'required|min:4|max:50',
            'title' => 'nullable|integer'
        ];
    }

    public function messages ()
    {
        return [
            'name.required' => 'وارد کردن نام ویژگی اجباری است !',
            'name.min' => 'نام ویژگی میبایست حداعقل 4 کاراکتر باشد !',
            'name.max' => 'نام ویژگی میبایست حداکثر 50 کاراکتر باشد !',
            'title.integer' => 'دستکاری در اطلاعات ارسالی تشخیص داده شده است ، لطفا دوباره تلاش کنید .'
        ];
    }
}
