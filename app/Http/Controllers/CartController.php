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
use Carbon\Carbon;
class CartController extends Controller
{
    use Init;

    public function index ()
    {
        $this -> check_cart();

        return view('store.shoping-cart', [
            'cart_products' => $this -> Get_Cart_items(),
            'top_groups' => $this -> Get_sub_groups(),
            'page_title' => 'سبد خرید',
            'options' => $this->options([
                'site_name', 'site_description', 'site_logo',
                'social_link', 'dollar_cost', 'shipping_cost'
            ])
        ]);
    }

    public function add ($id, $title, $count, $color = null)
    {
        $product = Product::select('price', 'unit', 'offer', 'label', 'stock_inventory')->where('pro_id', $id)->get();
        if ($product->all() == []) { return redirect()->back(); }

        if ($product[0]->label !== null)
        {
            return redirect()->back()->with('message', 'متاسفانه امکان ثبت این محصول در حال حاضر ممکن نیست .')
                ->with('message_type', 'warning');
        }
        else if ($product[0]->stock_inventory < $count)
        {
            return redirect()->back()->with('message', 'متاسفانه در حاضر موجودی انبار این محصول حداکثر '.$product[0]->stock_inventory.' عدد است ')
                ->with('message_type', 'warning');
        }

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
        $result = $this -> check_cart(true, $req);

        return $result;
    }

    public function check_cart ($decrease = false, $req = NULL)
    {
        if (Auth::check())
        {
            $order = Order::select('id')->where('buyer', Auth::user()->id)->where('status', 0)->get();

            if ($order->all() == []) { return ['status' => false]; }

            $order_id = $order[0] -> id;
            $id = [];

            if ($decrease)
            {
                foreach ($req -> products as $key => $item) {
                    $id[] = $key;
                }
            }
            else
            {
                $temp = OrderProducts::select('product')->where('order', $order_id)->get();
                foreach ($temp as $value) { $id[] = $value -> product; }
            }

            $cart_products = Product::select('pro_id', 'price', 'unit', 'offer', 'label', 'stock_inventory')
                    ->whereIn('pro_id', $id)->get();

            $total = $offer = 0;

            $options = Option::select('name', 'value')->whereIn('name', ['dollar_cost', 'shipping_cost'])->get();
            foreach ($options as $option) {
                switch ($option['name']) {
                    case 'dollar_cost': $dollar_cost = $option['value']; break;
                    case 'shipping_cost': $shipping_cost = json_decode($option['value'], true); break;
                }
            }

            if ($decrease)
            {
                $shipping_cost = $shipping_cost[$req->shipping_cost]['cost'];
            }
            
            foreach ($cart_products as $item)
            {
                if ($item->unit)
                {
                    $item->price = $item->price * $dollar_cost;
                    
                    $temp = 1; if ($decrease) { $temp = $req -> products[$item['pro_id']]['count']; }
                    $total += $item->price * $temp;
                }

                if ($item -> offer != 0)
                {
                    $item -> offer = ($item->offer * $item->price) / 100;
                    $temp = 1; if ($decrease) { $temp = $req -> products[$item['pro_id']]['count']; }
                    $offer += $item->offer * $temp;
                }
                
                $cart_product = OrderProducts::select('id')->where('product', $item['pro_id'])->get();
                
                if ($item -> label !== null)
                {
                    OrderProducts::destroy($cart_product[0] -> id);
                }
                else
                {
                    if ($decrease)
                    {
                        if ($item -> stock_inventory < $req -> products[$item['pro_id']]['count'])
                        {
                            $count = $item -> stock_inventory < $req;
                        }
                        else
                        {
                            $count = $req -> products[$item['pro_id']]['count'];
                        }
                    }
                    else
                    {
                        $count = OrderProducts::select('count')->where('id', $cart_product[0] -> id)->get();
                        if ($item -> stock_inventory < $count[0] -> count)
                        {
                            $count = $item -> stock_inventory;
                        }
                        else
                        {
                            $count = $count[0] -> count;
                        }
                    }

                    $cart_product = OrderProducts::find($cart_product[0] -> id);
                    if ($decrease)
                    {
                        $cart_product -> color = $req -> products[$item['pro_id']]['color'];
                    }
                    $cart_product -> count = $count;
                    $cart_product -> price = $item->price;
                    $cart_product -> offer = $item->offer;
                    $cart_product -> save();

                    if ($decrease)
                    {
                        $product = Product::find($item['pro_id']);
                        $product -> stock_inventory = $product -> stock_inventory - $count;
                        $product -> save();
                    }
                }

            }

            $order = Order::find($order_id);
            $order -> offer = $offer;
            $order -> total = $total;
            $order -> shipping_cost = 0;
            if ($decrease) {
                $order -> destination = $req->address;
                $order -> postal_code = $req->postal_code;
                $order -> buyer_description = $req->description;
                $order -> shipping_cost = $shipping_cost;
                $order -> status = 1;
                $datetimes = json_decode($order -> datetimes, true);
                $datetimes['awaitingPayment'] = time();
                $order -> datetimes = json_encode($datetimes);
            }
            $order -> save();
            
            return [
                'status' => true,
                'amount' => ($order -> total + $order -> shipping_cost) - $order -> offer,
                'order_id' => $order -> id
            ];
        } 
        else
        {
            return ['status' => false];
        }
    }

    public function paymentGateway ($factor_total, $order_id)
    {
        $site_name = Option::select('name', 'value')->where('name', 'site_name')->get();
        $site_name = $site_name[0] -> value;
        
        $MerchantID = 'dd5e2112-c720-11e8-8292-000c295eb8fc';
        $Amount = $factor_total;
        $Description = 'پرداخت فاکتور ' . $order_id . ' در فروشگاه ' . $site_name;
        $Email = \Auth::user()->email;
        $Mobile = \Auth::user()->phone;
        $CallbackURL = 'http://hicostore.ir/verify_payment';

        $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest([
            'MerchantID' => $MerchantID,
            'Amount' => $Amount,
            'Description' => $Description,
            'Email' => Auth::user()->email,
            'Mobile' => Auth::user()->phone,
            'CallbackURL' => $CallbackURL,
        ]);

        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100)
        {
            $order = Order::find($order_id);
            $order -> auth_code = $result->Authority;
            $order -> save();

            Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
        }
        else
        {
            $this -> restore_cart();
            return view('errors.errors', [
                'error_title' => 'متاسفانه در هنگاه اتصال به درگاه خطایی رخ داد',
                'error_message' => $result->Status, 
            ]);
        }
    }

    public function verify_payment ()
    {
        $MerchantID = 'dd5e2112-c720-11e8-8292-000c295eb8fc';
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
                $order = Order::select('id')->where('auth_code', $Authority)->get();
                $order -> payment_code = $result->RefID;
                $time = Carbon::now();
                $order -> payment = $time;
                $jalili_time = \App\Classes\jdf::gregorian_to_jalali($time->year, $time->month, $time->day, '-');	
                $jalili_time .= ' '. $time->hour . ':' . $time->minute . ':' . $time->secound . ':';
                $order -> payment_jalali = $jalili_time;
                $order -> save();

                $message = 'پرداخت شما به شناسه پرداخت <b>' . $result->RefID . '</b> با موفقیت انجام شد .<br/>
                    سفارش شما به زودی بررسی و ارسال خواهد شد و شما میتوانید از همین صفحه وضعیت سفارش خود
                    را بررسی کنید .';
                
                return redirect('/orders')->back()->with('message', $message);
            }
            else
            {
                $this -> restore_cart();
                return view('errors.errors', [
                    'error_title' => 'در فرآیند پرداخت خطایی رخ داد',
                    'error_message' => 'متاسفانه در فرآیند پرداخت شما خطایی رخ داد ، چنانچه وجهی از حساب شما کسر شده است ، در طی 72 ساعت آینده به حاسب شما بازخواهد گشت .', 
                ]);
            }
        }
        else
        {
            $this -> restore_cart();
            return view('errors.errors', [
                'error_title' => 'لفو شد',
                'error_message' => 'عملیات پرداخت توسط شما لغو شد ، اگر مایل هستید دوباره به فرآیند پرداخت بازگردید ، از <a href="/cart">صفحه سبد خرید</a> خود دوباره اقدام کنید .', 
            ]);
        }
    }
}