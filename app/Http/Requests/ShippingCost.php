<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCost extends FormRequest
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
            'shipping_cost' => 'required|array|size:4',
            'shipping_cost.*' => 'required|integer|min:0',
        ];
    }

    public function messages ()
    {
        return [
            'shipping_cost.required' => 'خطا در اطلاعات ارسالی‌ ، لطفا دوباره تلاش کنید',
            'shipping_cost.size' => 'خطا در اطلاعات ارسالی‌ ، لطفا دوباره تلاش کنید',
            'shipping_cost.array' => 'خطا در اطلاعات ارسالی‌ ، لطفا دوباره تلاش کنید',
       
            'shipping_cost.*.required' => 'وارد کردن هزینه کلیه متد ها الزامی است',
            'shipping_cost.*.min' => 'هزینه متد های ارسال حداقل 0 تومان میباشد !',
            'shipping_cost.*.integer' => 'لطفا هزینه ارسال را به عدد وارد کنید',
       ];
    }
}