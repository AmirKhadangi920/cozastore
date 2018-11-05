<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Info extends FormRequest
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
            'site_name' => 'required|max:30|string',
            'phone' => ['required', 'regex:/(\+98|0)?9\d{9}/'],
            'description' => 'required|max:255|string',
            'address' => 'required|max:100|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:512'
        ];
    }

    public function messages ()
    {
        return [
            'site_name.required' => 'وارد کردن عنوان سایت اجباری است',
            'site_name.max' => 'عنوان وبسایت میبایست حداکثر ۳۰ کاراکتر باشد',
            'site_name.string' => 'عنوان وبسایت فقط شامل حرف یا عدد میباشد',
            
            'phone.required' => 'وارد کردن شماره تلفن اجباری است',
            'phone.regex' => 'لطفا شماره تلفن خود را به درستی وارد کنید ، شماره تلفن فقط شامل عدد است و با پیش شماره 0 یا +98 شروع میشود !',
            
            'description.required' => 'وارد کردن توضیح درباره سایت اجباری است',
            'description.max' => 'عنوان توضیح درباره میبایست حداکثر 255 کاراکتر باشد',
            'description.string' => 'توضیحات فقط شامل حرف یا عدد میباشد',
            
            'address.required' => 'وارد کردن آدرس سایت اجباری است',
            'address.max' => 'آدرس میبایست حداکثر ۳۰ کاراکتر باشد',
            'address.string' => 'آدرس فقط شامل حرف یا عدد میباشد',

            'logo.image' => 'فایل انتخابی برای لوگوی وبسایت میبایست از نوع عکس باشد',
            'logo.mimes' => 'فرمت های مجاز برای تصویر لوگو فقط jpg , jpeg و png میباشد',
            'logo.max' => 'لوگوی وبسایت میبایست حداکثر ۵۱۲ کیلوبایت باشد',
        ];
    }
}