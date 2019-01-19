<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PayRequest;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Option;
use App\Models\DiscountCode;
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
    /**
     * Show the Cart view for client user
     *
     * @return view store.cart
     */
    public function index ()
    {
        if ( Auth::check() )
        {
            if ( !Order::where('buyer', Auth::user()->id)->where('status', 0)->first() )
                return redirect()->back()->withErrors(['لطفا برای مشاهده سبد خرید ابتدا محصولی به سبد خرید خود اضافه کنید']);
        }

        $this->check_cart();
        
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

    /**
     * Add a variation to cart items
     * it can manage both cookie and DB driver
     *
     * @param ProductVariation $variation
     * @param boolean $response
     * @return void
     */
    public function add (ProductVariation $variation, $response = true)
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
            
            if ( $response )
                return redirect()->back()->with('message', $variation->product->name.' با موفقیت به سبد خرید شما اضافه شد .');
        }

        // If the use doesn't logged in , save it's order item in cookies
        $cart =  json_decode(Cookie::get('cart'), true);
        $cart[ $variation->id ] = $values['quantity'];
        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);

        if ( $response )
            return redirect()->back()->with('message', $variation->product->name.' با موفقیت به سبد خرید شما اضافه شد .');
    }

    /**
     * Remove a varation from cart items
     * it can manage both cookie and DB driver
     *
     * @param ProductVariation $variation
     * @return void
     */
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

    public function discount_code ($discount_code)
    {
        if ( !$discount_code = DiscountCode::where('code', $discount_code)->whereNull('using_time')->first() )
            return redirect()->back()->withErrors(['کد تخفیفی که وارد کردید معتبر نیست یا قبلا استفاده شده است']);

        $min_total = $this->options(['min_total'])['min_total'];
        Order::where('buyer', Auth::user()->id)->where('status', 0)->update([
            'discount_code_id' => $discount_code->id
        ]);

        return redirect()->back()->with('message', "کد تخفیف {$discount_code->code} به سفارش شما اضافه شد , 
            ولی در صورتی که مبلغ سفارش کمتر از {$min_total} تومان باشد لحاظ نخواهد شد !");
    }

    /**
     * return checkout page
     *
     * @param Request $request
     * @return view store.checkout
     */
    public function checkout (Request $request)
    {
        if ( $request->all() )
        {
            // Validate input data
            $values = Validator::make($request->all() , [
                'cart'          => 'required|array|min:1',
                'cart.*'        => 'required|integer|exists:order_items,id',
                'shipping_type' => 'in:model1,model2,model3,model4',
            ])->validate();
            // update order item count
            foreach ( $request->cart as $order_item => $count )
            {
                OrderItem::find( $order_item )->update(['count' => $count]);
            }
            $shipping_cost = (array) $this->options(['shipping_cost'])['shipping_cost'];
            $order = Order::where('buyer', Auth::user()->id)->where('status', 0)->update([
                'shipping_type' => $values['shipping_type'],
                'shipping_cost' => $shipping_cost[ $values['shipping_type'] ]->cost
            ]);
        }
        $this->check_cart();

        // redirect user if cart is empty
        if ( !$cart = $this->Get_Cart_items([ 'more' => true ]) )
        {
            return redirect('/cart')->withErrors(['تا زمانی که محصولی به سبد خرید اضافه خود نکنید , امکان تکمیل پرداخت وجود ندارد']);
        }

        return view('store.checkout  ', [
            'products'      => Product::productCard(),
            'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'groups'        => $this -> Get_sub_groups(),
            'cart_products' => $cart,
            'brands'        => Brand::all(),
            'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => 'تکمیل سفارش',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description', 'shipping_cost',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    /**
     * Get a payment request from user client
     *
     * @param PayRequest $request
     * @return $this->payment_gateway or redirect
     */
    public function pay (PayRequest $request)
    {
        $result = $this->check_cart($request, false); // ** return <- false to true

        if ( !$result['status'] )
            return redirect()->back()->withErrors(['مشکلی در آماده سازی درگاه پرداخت به وجود آمد , لطفا دوباره تلاش کنید']);    

        return $this->payment_gateway( $result['amount'], $result['order_id'] );
    }

    /**
     * Check the product label & stock inventory for cart items
     * also calcuate order total and offer
     *
     * @param Request $request
     * @param boolean $decrease
     * @return void
     */
    public function check_cart (Request $request = NULL, $decrease = false)
    {
        if (Auth::check())
        {
            $order = Order::select('id', 'discount_code_id')
                ->with([
                    'discount_code',
                    'items',
                    'items.variation:id,product_id,price,unit,offer,offer_deadline,stock_inventory',
                    'items.variation.product:id,label',
                ])
                ->where('buyer', Auth::user()->id)
                ->where('status', 0)
                ->first();
            
            if ( $order )
            {
                $order_total = 0;
                $offer_total = 0;
                $options = $this->options(['shipping_cost', 'dollar_cost', 'min_total']);

                $order->items->each( function ( $item ) use ( &$order_total, &$offer_total, $options, $decrease ) 
                {
                    $item->price = $item->variation->price;
                    // Check the product has offer unit or not
                    if ( $item->variation->offer && $item->variation->deadline->gt(now()) )
                    {
                        $item->price = $item->variation->offer;
                        $item->offer = $item->variation->price - $item->variation->offer;
                    }

                    // Multiplication $ cost with product price & offer
                    if ( $item->variation->unit )
                    {
                        $item->price *= $options['dollar_cost'];
                        $item->offer *= $options['dollar_cost'];
                    }
                    $item->save();
            
                    // remove order item if the product has label
                    if ( in_array( $item->variation->product->label, [1, 2, 3, 4]) )
                    {
                        $item->delete();
                    }
                    // check the stock_inventory of product
                    elseif ( $item->variation->stock_inventory <= $item->count )
                    {
                        $item->update(['count' => $item->variation->stock_inventory]);
                        if ( $item->count == 0 ) $item->delete();
                    }

                    // decrease product inventory if it's requerid
                    if ( $decrease )
                        $item->variation->decrement( 'stock_inventory', $item->count );

                    $order_total += $item->price * $item->count;
                    $offer_total += $item->offer * $item->count;
                });

                if ( $order_total >= $options['min_total'] )
                {
                    if ( $order->discount_code && is_null( $order->discount_code->using_time ) )
                    {
                        $offer_total += $order->discount_code->value;
                        $order->discount_code->update([ 'using_time' => now() ]);
                    }
                }

                $temp_order = [
                    'total' => $order_total,
                    'offer' => $offer_total,
                ];

                if ( $request ) 
                {
                    $shipping_cost = (array) $options['shipping_cost'];

                    $datetimes = json_decode($order->datetimes, true);
                    $datetimes['awaitingPayment'] = time();

                    $temp_order = array_merge( $temp_order, [
                        'destination'       => $request->state.' , '.$request->city.' , '.$request->address,
                        'postal_code'       => $request->postal_code,
                        'buyer_description' => $request->buyer_description,
                        // 'status'            => 1,
                        'shipping_type'     => $request->shipping_type,
                        'shipping_cost'     => $shipping_cost[ $request->shipping_type ]->cost,
                        'datetimes'         => json_encode($datetimes),
                    ]);
                }

                $order->update( $temp_order );

                return [
                    'status' => true,
                    'amount' => $order->total - $order->offer + $order->shipping_cost,
                    'order_id' => $order->id
                ];
            }
            else 
                return [ 'status' => false ];
        } 
        else
            return ['status' => false];
    }

    /**
     * Send request to payment gatway and submit authority code
     * for specified order
     *
     * @param Integer $total
     * @param Integer $order_id
     * @return void
     */
    public function payment_gateway ( $total, $order_id )
    {
        $site_name = $this->options(['site_name'])['site_name'];
        
        $MerchantID = 'dd5e2112-c720-11e8-8292-000c295eb8fc'; //Required
        $Amount = $total; //Amount will be based on Toman - Required
        $Description = "پرداخت فاکتور #{$order_id} در فروشگاه {$site_name}"; // Required
        $Email = \Auth::user()->email;
        $Mobile = \Auth::user()->phone;
        $CallbackURL = \URL::to('/verify_payment'); // Required
    
        $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest([
            'MerchantID' => $MerchantID,
            'Amount' => $Amount,
            'Description' => $Description,
            'Email' => $Email,
            'Mobile' => $Mobile,
            'CallbackURL' => $CallbackURL,
        ]);
            
        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100)
        {
            Order::findOrFail($order_id)->update([ 'auth_code' => $result->Authority ]);
            return redirect('https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
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

    /**
     * Verify payment result from payment
     *
     * @return void
     */
    public function verify_payment ()
    {
        $MerchantID = 'dd5e2112-c720-11e8-8292-000c295eb8fc';
        $Authority = $_GET['Authority'];
        
        $order = Order::where('auth_code', $_GET['Authority'])->firstOrFail();
        
        $Amount = ( $order -> total + $order -> shipping_cost ) - $order -> offer;
        
        if ($_GET['Status'] == 'OK')
        {
            $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            $result = $client->PaymentVerification([
                'MerchantID' => $MerchantID,
                'Authority' => $Authority,
                'Amount' => $Amount,
            ]);
            
            if ($result->Status == 100 || $result->Status == 101)
            {
                $order->ref_id = $result->RefID;
                $time = Carbon::now();
                $order -> payment = $time;
                $jalali_time = \App\Classes\jdf::gregorian_to_jalali($time->year, $time->month, $time->day, '-');	
                $jalali_time .= ' '. $time->hour . ':' . $time->minute . ':' . $time->second;
                $order->payment_jalali = $jalali_time;
                $order->status = 2;
                $order -> save();

                $message = 'پرداخت شما به شناسه پرداخت <b>#' . $result->RefID . '</b> با موفقیت انجام شد .<br/>
                    سفارش شما به زودی بررسی و ارسال خواهد شد و شما میتوانید از همین صفحه وضعیت سفارش خود
                    را بررسی کنید .';
                
                return redirect('/orders/'.$order->id)->with('message', $message);
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