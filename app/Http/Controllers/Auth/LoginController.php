<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Option;
use App\Product;
use Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $options = Option::select('name', 'value')->whereIn('name',
            ['site_name', 'site_logo', 'site_description', 'social_link'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
                case 'site_description': $site_description = $option['value']; break;
                case 'social_link': $social_link = json_decode($option['value'], true); break;
            }
        }

        $cart_products = [];
        $cart =  json_decode(Cookie::get('cart'), true);
        if ($cart)
        {
            foreach ($cart as $key => $item)
            {
                $id[] = $item['id'];
            }
            
            $cart_products = Product::select('pro_id', 'name', 'price', 'unit',
                'offer', 'photo')->whereIn('pro_id', $id)->get(); 
        }

        return view('auth.login', [
            'page_title' => 'ورود به حساب',
            'site_name'=> $site_name,
            'site_logo'=> $site_logo,
            'site_description'=> $site_description,
            'social_link'=> $social_link,
            'cart_products' => $cart_products,
            'dollar_cost' => 14500,
        ]);
    }
}
