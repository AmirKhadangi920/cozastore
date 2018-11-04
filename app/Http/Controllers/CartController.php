<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderProducts;
use Cookie;
use Auth;

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
        if (Auth::check())
        {
            $order = Order::select('id')->where('buyer', Auth::user()->id)->where('status', 0)->get();
            if (!empty($order->all())) {

                $order_product = OrderProducts::select('id')->where('order', $order[0]->id)
                ->where('product', $id)->get();
                
                if (!empty($order_product->all())) {
                    $order_product = OrderProducts::find($order_product[0]->id);
                    $order_product -> color = $color;
                    $order_product -> count = $count;
                    $order_product -> save();
                } else {
                    $order_product = new OrderProducts();
                    $order_product -> order = $order[0]->id;
                    $order_product -> product = $id;
                    $order_product -> color = $color;
                    $order_product -> count = $count;
                    $order_product -> save(); 
                }

            } else {
                $order = new Order();
                $order -> id = substr(md5(time()), 0, 8);
                $order -> buyer = Auth::user()->id;
                $order -> code = substr(md5(time() + rand()), 0, 8);
                $order -> destination = Auth::user()->state.' ، '.Auth::user()->city.' ، '.Auth::user()->address;
                $order -> postal_code = Auth::user()->postal_code;
                $order -> save();

                return redirect()->back()->with('message', $title.' با موفقیت به سبد خرید شما اضافه شد .');
            }
        }

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
        if (Auth::check())
        {
            $order = Order::select('id')->where('buyer', Auth::user()->id)->where('status', 0)->get();
            if (!empty($order->all())) {
                $order_product = OrderProducts::select('id')->where('order', $order[0]->id)
                ->where('product', $id)->get();
                
                if (!empty($order_product->all())) {
                    OrderProducts::destroy($order_product[0]->id);
                }
            }
        }

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
