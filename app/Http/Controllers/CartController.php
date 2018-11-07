<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Order;
use App\OrderProducts;
use App\Option;
use Cookie;
use Auth;
use App\Traits\Init;

class CartController extends Controller
{
    use Init;

    public function index (Request $request)
    {
        $options = Option::select('name', 'value')->whereIn('name', 
            ['site_name', 'site_description', 'site_logo', 'social_link', 'dollar_cost', 'shipping_cost'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'slider': $slider = json_decode($option['value'], true); break;
                case 'posters': $posters = json_decode($option['value'], true); break;
                case 'site_name': $site_name = $option['value']; break;
                case 'site_description': $site_description = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
                case 'dollar_cost': $dollar_cost = $option['value']; break;
                case 'social_link': $social_link = json_decode($option['value'], true); break;
                case 'shipping_cost': $shipping_cost = json_decode($option['value'], true); break;
            }
        }



        return view('store.shoping-cart', [
            'cart_products' => $this -> Get_Cart_items(),
            'dollar_cost' => $dollar_cost,
            'page_title' => 'سبد خرید',
            'site_name' => $site_name,
            'site_description' => $site_description,
            'shipping_cost' => $shipping_cost,
            'site_logo' => $site_logo,
            'social_link' => $social_link,
        ]);
    }

    public function add ($id, $title, $count, $color = null)
    {
        $product = Product::select('price', 'unit', 'offer')->where('pro_id', $id)->get();
        if ($product->all() == []) { return abort('404'); }

        if (Auth::check())
        {
            $order = Order::select('id')->where('buyer', Auth::user()->id)->where('status', 0)->get();
            if (!empty($order->all()))
            {
                $order_product = new OrderProducts();
                $order_product -> order = $order[0]->id;
                $order_product -> product = $id;
                $order_product -> color = $color;
                $order_product -> count = $count;
                $order_product -> save(); 
            }
            else
            {
                $order = new Order();
                $order -> id = substr(md5(time()), 0, 8);
                $order -> buyer = Auth::user()->id;
                $order -> destination = Auth::user()->state.' ، '.Auth::user()->city.' ، '.Auth::user()->address;
                $order -> postal_code = Auth::user()->postal_code;
                $order -> save();

                $order_product = OrderProducts::select('id')->where('order', $order -> id)
                    ->where('product', $id)->get();
                
                if (!empty($order_product->all())) {
                    $order_product = OrderProducts::find($order_product[0]->id);
                    $order_product -> color = $color;
                    $order_product -> count = $count;
                    $order_product -> save();
                } else {
                    $order_product = new OrderProducts();
                    $order_product -> order = $order -> id;
                    $order_product -> product = $id;
                    $order_product -> color = $color;
                    $order_product -> count = $count;
                    $order_product -> save(); 
                }
            }

            return redirect()->back()->with('message', $title.' با موفقیت به سبد خرید شما اضافه شد .');
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
                    return redirect()->back()->with('message', $title.' با موفقیت از سبد خرید شما حذف شد .');
                } else {
                    return redirect()->back();
                }
            } else {
                return redirect()->back();
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

    public function pay (Request $req)
    {
        if (Auth::check())
        {
            $order = Order::select('id')->where('buyer', Auth::user()->id)->where('status', 0)->get();

            if ($order->all() == []) { return abort('404'); }
            $order_id = $order[0] -> id;
            $id = [];
            foreach ($req->products as $key => $value) { $id[] = $key; }

            
            $cart_products = Product::select('pro_id', 'price', 'unit', 'offer')
                ->whereIn('pro_id', $id)->get();

            $total = $offer = 0;

            $options = Option::select('name', 'value')->whereIn('name', ['dollar_cost', 'shipping_cost'])->get();
            foreach ($options as $option) {
                switch ($option['name']) {
                    case 'dollar_cost': $dollar_cost = $option['value']; break;
                    case 'shipping_cost': $shipping_cost = json_decode($option['value'], true); break;
                }
            }

            $dollar_cost = $dollar_cost; // this should get from server
            $shipping_cost = $shipping_cost[$req->shipping_cost]['cost'];
            
            foreach ($cart_products as $item)
            {
                if ($item->unit)
                {
                    $item->price = $item->price * $dollar_cost;
                    $total += $item->price * $req -> products[$item['pro_id']]['count'];
                }

                if ($item -> offer != 0)
                {
                    $item -> offer = ($item->offer * $item->price) / 100;
                    $offer += $item->offer * $req -> products[$item['pro_id']]['count'];
                }
                
                $cart_product = OrderProducts::select('id')->where('product', $item['pro_id'])->get();
                $cart_product = OrderProducts::find($cart_product[0] -> id);
                $cart_product -> color = $req -> products[$item['pro_id']]['color'];
                $cart_product -> count = $req -> products[$item['pro_id']]['count'];
                $cart_product -> price = $item->price;
                $cart_product -> offer = $item->offer;
                $cart_product -> save();
            }

            $order = Order::find($order_id);
            $order -> destination = $req->address;
            $order -> postal_code = $req->postal_code;
            $order -> buyer_description = $req->description;
            $order -> offer = $offer;
            $order -> shipping_cost = $shipping_cost;
            $order -> total = $total;
            $order -> status = 1;
            $datetimes = json_decode($order -> datetimes, true);
            $datetimes['awaitingPayment'] = time();
            $order -> datetimes = json_encode($datetimes);
            $order -> save();
            
            return 'every thing doing ok';
        }
        else
        {
            return redirect()->back();
        }
    }

    public function paymentGateway ()
    {
        $site_name = Option::select('name', 'value')->whereIn('name', 'site_name')->get();
        $site_name = $site_name[0] -> value;
        
        $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
        $Amount = 1000; //Amount will be based on Toman - Required
        $Description = 'پرداخت فاکتور شما در فروشگاه ' . $site_name; // Required
        // $Email = 'UserEmail@Mail.Com'; // Optional
        // $Mobile = '09123456789'; // Optional
        $CallbackURL = 'http://hicostore.ir/verify_payment'; // Required


        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest([
            'MerchantID' => $MerchantID,
            'Amount' => $Amount,
            'Description' => $Description,
            // 'Email' => $Email,
            // 'Mobile' => $Mobile,
            'CallbackURL' => $CallbackURL,
        ]);

        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100)
        {
            Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
        }
        else
        {
            echo 'ERR: '.$result->Status;
        }
    }

    public function verify_payment ()
    {
        $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
        $Amount = 1000; //Amount will be based on Toman
        $Authority = $_GET['Authority'];

        if ($_GET['Status'] == 'OK')
        {
            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            $result = $client->PaymentVerification([
                'MerchantID' => $MerchantID,
                'Authority' => $Authority,
                'Amount' => $Amount,
            ]);

            if ($result->Status == 100)
            {
                echo 'Transaction success. RefID:'.$result->RefID;
            }
            else
            {
                echo 'Transaction failed. Status:'.$result->Status;
            }
        }
        else
        {
            echo 'Transaction canceled by user';
        }
    }
}
