<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cookie;

class CartController extends Controller
{
    public function index (Request $request)
    {
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

        return view('store.shoping-cart', [
            'cart_products' => $cart_products,
            'dollar_cost' => 14500,
        ]);
    }

    public function add ($id, $title, $count = 2, $color = null)
    {
        $cart =  json_decode(Cookie::get('cart'), true);
        if ($cart)
        {
            foreach ($cart as $key => $item)
            {
                if ($item['id'] == $id)
                {
                    $cart[$key] = [
                        'id' => $id,
                        'count' => $count,
                        'color' => $color
                    ];
                    Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);
                    
                    return redirect()->back()->with('message', $title.' با موفقیت در سبد خرید شما اصلاح شد .');            
                }
            }
        }

        $cart[time()] = [
            'id' => $id,
            'count' => $count,
            'color' => $color
        ];        
        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);
     
        return redirect()->back()->with('message', $title.' با موفقیت به سبد خرید شما اضافه شد .');
    }

    public function remove ($id, $title)
    {
        $cart =  json_decode(Cookie::get('cart'), true);
        if ($cart) 
        {
            foreach ($cart as $key => $item) {
                if ($item['id'] == $id)
                {
                    unset($cart[$key]);
                    Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);
                    
                    return redirect()->back()->with('message', $title.' با موفقیت از سبد خرید شما حذف شد .');
                }
            }
        }
        return redirect()->back();
    }
}
