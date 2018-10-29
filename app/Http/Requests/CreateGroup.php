<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGroup extends FormRequest
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
            'title' => 'required|min:6|max:50',
            'parent' => 'nullable|integer',
            'description' => 'nullable|max:255'
        ];
    }

    public function messages ()
    {
        return [
            'title.required' => 'وارد کردن نام گروه اجباری است .',
            'title.min' => 'نام گروه میبایست حداعقل 6 کاراکتر باشد !',
            'title.max' => 'نام گروه میبایست حداکثر 50 کاراکتر باشد !',
            'parent.integer' => 'دستکاری در اطلاعات ارسالی تشخیص داده شده است ، لطفا دوباره تلاش کنید .',
            'description.max' => 'توضیح گروه میبایست حداکثر 255 کاراکتر باشد !',
        ];
    }
}
