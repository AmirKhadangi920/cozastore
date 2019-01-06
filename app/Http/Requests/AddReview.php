<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddReview extends FormRequest
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
            'value'     => 'required|integer|min:0|max:5',
            'quality'   => 'required|integer|min:0|max:5',
            'design'    => 'required|integer|min:0|max:5',
            'total'     => 'required|integer|min:0|max:5',
            'review'    => 'required|string',
        ];
    }

    public function messages ()
    {
        return [
            'fullname.required' => 'لطفا نام و نام خانوادگی خود را وارد کنید',
            'fullname.min'      => 'نام و نام خانوادگی میبایست حداقل 6 کاراکتر باشد !',
            'fullname.max'      => 'نام و نام خانوادگی میبایست حداکثر 50 کاراکتر باشد !',
            'email.required'    => 'لطفا آدرس ایمیل خود را وارد کنید',
            'email.email'       => 'لطفا آدرس ایمیل خود را به درستی وارد کنید',
            'email.max'         => 'نام و نام خانوادگی میبایست حداکثر 50 کاراکتر باشد !',
            'rating.required'   => 'لطفا امتیاز خود را وارد کنید',
            'rating.integer'    => 'لطفا امتیاز خود را به درستی وارد کنید',
            'rating.min'        => 'امتیاز میبایست حداقل 0 باشد !',
            'rating.max'        => 'امتیاز میبایست حداکثر 5 باشد !',
            'review.required'   => 'لطفا نظر خود را وارد کنید',
        ];
    }
}
