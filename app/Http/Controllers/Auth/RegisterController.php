<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Option;
use App\Models\Product;
use Cookie;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[پچجحخهعغآفقثصضشسیبلاتنمکگوئدذرزطظژ\s]+$/u'],
            'last_name' => ['required', 'string', 'min:3', 'max:30', 'regex:/^[پچجحخهعغآفقثصضشسیبلاتنمکگوئدذرزطظژ\s]+$/u'],
            'phone' => ['required', 'regex:/^(\+98|0)?9\d{9}$/'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'state' => ['required', 'max:30', 'regex:/^[پچجحخهعغآفقثصضشسیبلاتنمکگوئدذرزطظژ\s]+$/u'],
            'city' => ['required', 'max:30', 'regex:/^[پچجحخهعغآفقثصضشسیبلاتنمکگوئدذرزطظژ\s]+$/u'],
            'address' => ['required', 'max:255', 'string'],
            'postal_code' => ['required', 'digits:10', 'integer'],
        ], [
            'id.size' => 'خطا در اطلاعات ارسالی تشخیص داده شده است ، لطفا دوباره تلاش کنید',
            'first_name.required' => 'لطفا نام خود را وارد کنید',
            'first_name.min' => 'نام ، میبایست حداعقل 3 کاراکتر باشد !',
            'first_name.max' => 'نام ، میبایست حداکثر 20 کاراکتر باشد !',
            'first_name.string' => 'لطفا نام خود را به درستی وارد کنید ، نام فقط شامل حروف فارسی است !',
            'first_name.regex' => 'لطفا نام خود را به درستی وارد کنید ، نام فقط شامل حروف فارسی است !',
            'last_name.required' => 'لطفا نام خانوادگی خود را وارد کنید',
            'last_name.min' => 'نام خانوادگی ، میبایست حداعقل 3 کاراکتر باشد !',
            'last_name.max' => 'نام خانوادگی ، میبایست حداکثر 30 کاراکتر باشد !',
            'last_name.string' => 'لطفا نام خانوادگی خود را به درستی وارد کنید ، نام خانوادگی فقط شامل حروف فارسی است !',
            'last_name.regex' => 'لطفا نام خانوادگی خود را به درستی وارد کنید ، نام خانوادگی فقط شامل حروف فارسی است !',
            'phone.required' => 'لطفا شماره تلفن خود را وارد کنید',
            'phone.regex' => 'لطفا شماره تلفن خود را به درستی وارد کنید ، شماره تلفن فقط شامل عدد است و با پیش شماره 0 یا +98 شروع میشود , همچنین میبایست شماره تلفن با اعداد انگلیسی وارد شود !',
            'email.required' => 'لطفا آدرس ایمیل خود را وارد کنید',
            'email.email' => 'لطفا آدرس ایمیل خود را به درستی وارد کنید ، فرمت صحیح آدرس ایمیل به این صورت است : example@example.com !',
            'email.max' => 'آدرس ایمیل ، میبایست حداکثر 100 کاراکتر باشد !',
            'email.unique' => 'با این ایمیل قبلا ثبت نام شده است !',
            'password.required' => 'لطفا رمز عبور خود را وارد کنید',
            'password.string' => 'لطفا رمز عبور خود را به درستی وارد کنید ، رمز ورودی شما شامل کاراکتر های غیر مجاز است',
            'password.min' => 'رمز عبور ، میبایست حداعقل 6 کاراکتر باشد !',
            'password.confirmed' => 'رمز عبور و تکرار آن با هم همخوانی ندارد',
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
            'postal_code.regex' => 'لطفا کد پستی خود را به درستی وارد کنید ، کدپستی فقط شامل عدد است , همچنین میبایست با اعداد انگلیسی وارد شود !',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'id' => substr(md5(time()), 0, 8),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'state' => $data['state'],
            'city' => $data['city'],
            'address' => $data['address'],
            'postal_code' => $data['postal_code'],
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register', [
            'options'=> $this->options(['site_name', 'site_logo'])
        ]);
    }
}
