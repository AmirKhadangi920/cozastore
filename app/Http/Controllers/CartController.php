<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Option;
use App\Models\ProductVariation;
use App\Traits\Init;
use Cookie;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Models\Brand;
use App\Models\OrderItem;
class CartController extends Controller
{
    public function index ()
    {
        return $this -> check_cart();

        return view('store.cart  ', [
            'products'      => Product::productCard(),
            'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'groups'        => $this -> Get_sub_groups(),
            'cart_products' => $this -> Get_Cart_items([ 'more' => true ]),
            'brands'        => Brand::all(),
            'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => 'سبد خرید',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description', 'shipping_cost',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function add (ProductVariation $variation)
    {
        // Validate input data and product status , stock_inventory
        $values = Validator::make([
                'quantity'  => $_GET['quantity'],
                'label'     => $variation->product->label,
                'inventory' => $variation->stock_inventory
            ], [
                'quantity'  => 'required|min:1|integer',
                'label'     => 'not_in:1,2,3,4',
                'inventory' => "integer|min:{$_GET['quantity']}"
            ], [
                'label.not_in'  => 'متاسفانه امکان ثبت این محصول در حال حاضر ممکن نیست .',
                'inventory.max' => 'متاسفانه در حاضر موجودی انبار این محصول حداکثر '.$variation->stock_inventory.' عدد است '
        ])->validate();

        // Get dollar_cost from options table
        if ( $variation->unit )
        {
            $dollar_cost = $this->options(['dollar_cost'])['dollar_cost'];
            $variation->price *= $dollar_cost;
            $variation->offer *= $dollar_cost;
        }

        // Check if the user has logged in , create order for his/him and assign variation to that
        if ( Auth::check() )
        {
            $order = Order::firstOrCreate([
                'buyer'       => Auth::user()->id,
                'status'      => 0,
            ], [
                'id'          => substr(md5( time().'_'.rand() ), 0, 8),
                'destination' => Auth::user()->state.' ، '.Auth::user()->city.' ، '.Auth::user()->address,
                'postal_code' => Auth::user()->postal_code
            ]);

            $order->items()->updateOrCreate([
                'variation_id' => $variation->id,
            ], [
                'count'        => $values['quantity'],
                'price'        => $variation->price,
                'offer'        => ( $variation->offer && $variation->offer < $variation->price )
                                        ? $variation->price - $variation->offer : 0
            ]);
            
            return redirect()->back()->with('message', $variation->product->name.' با موفقیت به سبد خرید شما اضافه شد .');
        }

        // If the use doesn't logged in , save it's order item in cookies
        $cart =  json_decode(Cookie::get('cart'), true);
        $cart[ $variation->id ] = $values['quantity'];
        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);

        return redirect()->back()->with('message', $variation->product->name.' با موفقیت به سبد خرید شما اضافه شد .');
    }

    public function remove (ProductVariation $variation)
    {
        // Check if user has logged in , remove a variation from order_items table in DB
        if ( Auth::check() )
        {
            $order = Order::select('id')->where('buyer', Auth::user()->id)->where('status', 0)->first();
            $variation->order_item()->where('order_id', $order->id)->delete();

            return redirect()->back()->with('message', $variation->product->name.' با موفقیت از سبد خرید شما حذف شد .');
        }
        // Check if user doesn't logged in , remove a variation from the Cookies
        elseif ( $cart =  json_decode(Cookie::get('cart'), true) ) 
        {
            unset( $cart[ $variation->id ] );
            Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);
            
            return redirect()->back()->with('message', $variation->product->name.' با موفقیت از سبد خرید شما حذف شد .');
        }
        
        return redirect()->back();
    }

    public function pay (Request $req)
    {
        $result = $this -> check_cart(true, $req);

        return $result;
    }

    public function check_cart (Request $request = NULL)
    {
        if (Auth::check())
        {
            $options = $this->options([ 'dollar_cost', 'shipping_cost' ]);

            $order = Order::select('id')
                ->with([
                    'items',
                    'items.variation:id,product_id,price,unit,offer,offer_deadline,stock_inventory',
                    'items.variation.product:id,label',
                ])
                ->where('buyer', Auth::user()->id)
                ->where('status', 0)
                ->first();
            
            if ( $order )
            {
                return $order->items;
                
                $order->items->each( function ( $item ) 
                {
                    if ( $item->variation->offer && $item->variation->deadline->gt(now()) )
                    {
                        $item->price = $item->variation->offer;
                        $item->offer = $item->variation->price - $item->variation->offer;
                    }

                    if ( $item->unit )
                    {
                        $item->price *= $options['dollar_cost'];
                        $item->offer *= $options['dollar_cost'];
                    }
            
                    if ( $item->variation->product->label !== null )
                    {
                        $item->remove();
                    }
                    else
                    {
                        // High Score
                        $count = OrderProducts::select('count')->where('id', $cart_product[0]->id )->get();
                        if ($item -> stock_inventory < $count[0] -> count)
                        {
                            $count = $item -> stock_inventory;
                        }
                        else
                        {
                            $count = $count[0] -> count;
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

                });
            }
            else 
                return [ 'status' => false ];
            

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
                'order_id' => $order->id
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