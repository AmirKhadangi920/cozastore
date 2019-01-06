<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Brand;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index ()
    {
        return view('panel.invoice-archive', [
            'orders' => Order::list(),
            'page_name' => 'invoices',
            'page_title' => 'سفارشات',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    public function get (Order $order)
    {
        return view('panel.invoice-details', [
            'invoice' => Order::full_info($order),
            'page_name' => 'invoices',
            'page_title' => 'فاکتور #' . $order->id,
            'options' => $this->options(['site_name', 'site_logo', 'dollar_cost'])
        ]);
    }

    public function description (Order $order, $description)
    {
        Validator::make([ 'description' => $description ], [
            'description' => 'required|max:255|string',
        ])->validate();

        $order->update(['admin_description' => $description]);
        return redirect()->back()->with('message', 'توضیح شما برای فاکتور '.$order->id.'# با موفقیت ثبت شد .');
    }

    public function status (Order $order, $status)
    {
        Validator::make([ 'status' => $status ], [
            'status' => 'required|min:0|max:7|integer',
        ])->validate();

        $datetimes = json_decode($order->datetimes, true);
        switch ($status) {
            case 0: $datetimes['unpaid'] = time(); break;
            case 1: $datetimes['awaitingPayment'] = time(); break;
            case 2: $datetimes['paid'] = time(); break;
            case 3: $datetimes['pending'] = time(); break;
            case 4: $datetimes['packing'] = time(); break;
            case 5: $datetimes['sending'] = time(); break;
            case 6: $datetimes['posted'] = time(); break;
            case 7: $datetimes['canceled'] = time(); break;
        }
        $order->update([
            'datetimes' => json_encode($datetimes),
            'status' => $status
        ]);
        return redirect()->back()->with('message', 'وضعییت فاکتور '.$order->id.'# با موفقیت تغییر کرد .');
    }

    public function user_orders ()
    {
        // return $orders = Order::where('buyer', \Auth::user()->id )->get();

        return view('store.orders', [
            'orders'        => Order::where('buyer', \Auth::user()->id )->get(),
            'products'      => Product::productCard(),
            'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'groups'        => $this -> Get_sub_groups(),
            'cart_products' => $this -> Get_Cart_items(),
            'brands'        => Brand::all(),
            'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => 'سفارشات',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description', 'shipping_cost',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function order_detail (Order $order)
    {
        // return Order::full_info($order);

        return view('store.order-detail', [
            'order'         => Order::full_info($order),
            'products'      => Product::productCard(),
            'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'groups'        => $this -> Get_sub_groups(),
            'cart_products' => $this -> Get_Cart_items(),
            'brands'        => Brand::all(),
            'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => 'سفارشات',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description', 'shipping_cost',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }
}
