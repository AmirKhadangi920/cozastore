<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadPhoto extends FormRequest
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
            'name' => 'nullable|min:6|max:30',
            'description' => 'nullable|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:512'
        ];
    }

    public function messages ()
    {
        return [
            'name.min' => 'نام تصویر میبایست حداقل 6 کاراکتر باشد !',
            'name.max' => 'نام تصویر میبایست حداکثر 30 کاراکتر باشد !',
            'description.max' => 'توضیح تصویر میبایست حداکثر 255 کاراکتر باشد !',
            'photo.required' => 'لطفا تصویر خود را انتخاب کنید', 
            'photo.image' => 'لطفا یک فایل عکس برای آپلود شدن انتخاب کنید', 
            'photo.mimes' => 'فقط فرمت های jpeg , jpg و png قابل قبول است !', 
            'photo.max' => 'اندازه عکس میبایست حداکثر 512 کیلوبایت باشد !', 
        ];
    }
}
