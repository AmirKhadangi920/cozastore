<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderProducts;
use App\Option;
use Cookie;
use Auth;

class CartController extends Controller
{
    public function index (Request $request)
    {
        $options = Option::select('name', 'value')->whereIn('name', 
            ['site_name', 'site_description', 'site_logo', 'social_link'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'slider': $slider = json_decode($option['value'], true); break;
                case 'posters': $posters = json_decode($option['value'], true); break;
                case 'site_name': $site_name = $option['value']; break;
                case 'site_description': $site_description = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
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

        return view('store.shoping-cart', [
            'cart_products' => $cart_products,
            'dollar_cost' => 14500,
            'page_title' => 'سبد خرید',
            'site_name' => $site_name,
            'site_description' => $site_description,
            'site_logo' => $site_logo,
            'social_link' => $social_link,
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
                $order -> destination = Auth::user()->state.' ، '.Auth::user()->city.' ، '.Auth::user()->address;
                $order -> postal_code = Auth::user()->postal_code;
                $order -> datetimes = '{"refund":null,"Pending":null,"packing":null,"sending":null,"sended":null}';
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
