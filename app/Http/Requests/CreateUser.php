<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
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
            'id' => 'required|size:8',
            'first_name' => 'required|min:3|max:20|regex:/^[پچجحخهعغآفقثصضشسیبلاتنمکگوئدذرزطظژ\s]+$/u',
            'last_name' => 'required|min:3|max:30|regex:/^[پچجحخهعغآفقثصضشسیبلاتنمکگوئدذرزطظژ\s]+$/u',
            'phone' => [ 'required', 'regex:/^(\+98|0)?9\d{9}$/' ],
            'email' => 'required|email|max:100',
            'state' => 'required|max:30|regex:/^[پچجحخهعغآفقثصضشسیبلاتنمکگوئدذرزطظژ\s]+$/u',
            'city' => 'required|max:30|regex:/^[پچجحخهعغآفقثصضشسیبلاتنمکگوئدذرزطظژ\s]+$/u',
            'address' => 'required|max:255|regex:/^[پچجحخهعغآ؟.،آفقثصضشسیبلاتنمکگوئدذرزطظژ!!ؤإأءًٌٍَُِّ\s]+$/u',
            'postal_code' => 'required|integer|size:10',
        ];
    }

    public function messages ()
    {
        return [
            'id.required' => 'خطا در اطلاعات ارسالی تشخیص داده شده است ، لطفا دوباره تلاش کنید',
            'id.size' => 'خطا در اطلاعات ارسالی تشخیص داده شده است ، لطفا دوباره تلاش کنید',
            'first_name.required' => 'لطفا نام خود را وارد کنید',
            'first_name.min' => 'نام ، میبایست حداعقل 3 کاراکتر باشد !',
            'first_name.max' => 'نام ، میبایست حداکثر 20 کاراکتر باشد !',
            'first_name.regex' => 'لطفا نام خود را به درستی وارد کنید ، نام فقط شامل حروف فارسی است !',
            'last_name.required' => 'لطفا نام خانوادگی خود را وارد کنید',
            'last_name.min' => 'نام خانوادگی ، میبایست حداعقل 3 کاراکتر باشد !',
            'last_name.max' => 'نام خانوادگی ، میبایست حداکثر 30 کاراکتر باشد !',
            'last_name.regex' => 'لطفا نام خانوادگی خود را به درستی وارد کنید ، نام خانوادگی فقط شامل حروف فارسی است !',
            'phone.required' => 'لطفا شماره تلفن خود را وارد کنید',
            'phone.regex' => 'لطفا شماره تلفن خود را به درستی وارد کنید ، شماره تلفن فقط شامل عدد است و با پیش شماره 0 یا +98 شروع میشود !',
            'email.required' => 'لطفا آدرس ایمیل خود را وارد کنید',
            'email.email' => 'لطفا آدرس ایمیل خود را به درستی وارد کنید ، فرمت صحیح آدرس ایمیل به این صورت است : example@example.com !',
            'email.max' => 'آدرس ایمیل ، میبایست حداکثر 100 کاراکتر باشد !',
            'state.required' => 'لطفا استان محل زندگی خود را وارد کنید',
            'state.max' => 'نام استان ، میبایست حداکثر 30 کاراکتر باشد !',
            'state.regex' => 'لطفا نام استان خود را به درستی وارد کنید ، نام استان فقط شامل حروف فارسی است !',
            'city.required' => 'لطفا شهر محل زندگی خود را وارد کنید',
            'city.max' => 'نام شهر ، میبایست حداکثر 30 کاراکتر باشد !',
            'city.regex' => 'لطفا نام شهر خود را به درستی وارد کنید ، نام شهر فقط شامل حروف فارسی است !',
            'address.required' => 'لطفا آدرس خود را وارد کنید',
            'address.max' => 'آدرس ، میبایست حداکثر 255 کاراکتر باشد !',
            'address.regex' => 'لطفا آدرس خود را به درستی وارد کنید ، آدرس فقط شامل حروف فارسی ، عدد ، نقطه (.) و ویرگول (،) است !',
            'postal_code.required' => 'لطفا کدپستی خود را وارد کنید',
            'postal_code.size' => 'کد پستی میبایست 10 رقمی باشد',
            'postal_code.integer' => 'لطفا کد پستی خود را به درستی وارد کنید ، کدپستی فقط شامل عدد است !',
        ];
    }
}
