<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\OrderProduct;
use App\Option;

class InvoiceController extends Controller
{
    public function index ()
    {
        $orders = DB::select("SELECT `orders`.`id`, `users`.`first_name`, `users`.`last_name`, `admin_description`,
                ((`shipping_cost` + `total`) - `offer`) as 'total', `status`, `orders`.`created_at`, `payment`
                FROM `orders` INNER JOIN `users` ON `orders`.`buyer` = `users`.`id`");

        $options = Option::select('name', 'value')->whereIn('name', ['site_name', 'site_logo'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
            }
        }

        return view('panel.invoice-archive', [
            'orders' => $orders,
            'page_name' => 'invoices',
            'page_title' => 'سفارشات',
            'site_name'=> $site_name,
            'site_logo'=> $site_logo
        ]);
    }

    public function get ($id)
    {
        $invoice = DB::select('SELECT `orders`.`id`, `users`.`first_name`, `users`.`last_name`,
                `state`, `city`, `address`, `email`, `phone`, `users`.`postal_code` AS \'user_postal_code\',
                `admin_description`, `buyer_description`, `destination`,
                `orders`.`postal_code`, `shipping_cost`, `total`, `offer`, `status`,
                `orders`.`created_at`, `payment`, `datetimes`, `orders`.`updated_at` 
                FROM `orders` INNER JOIN `users` ON `orders`.`buyer` = `users`.`id`
                WHERE `orders`.`id` = ?', [$id]);

        if ($invoice == []) { return abort(404); }

        $order_products = DB::select('SELECT `color`, `count`, `order_products`.`created_at`, `name`,
                `photo`, `products`.`price`, `offer`, `unit`   FROM `order_products`
                INNER JOIN `products` ON `order_products`.`product` = `products`.`pro_id`
                WHERE `order_products`.`order` = ?', [$id]);

        $options = Option::select('name', 'value')->whereIn('name', ['site_name', 'site_logo'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
            }
        }

        return view('panel.invoice-details', [
            'invoice' => $invoice[0],
            'order_products' => $order_products,
            'page_name' => 'invoices',
            'dollar_cost' => 14500,
            'page_title' => 'فاکتور #' . $invoice[0] -> id,
            'site_name'=> $site_name,
            'site_logo'=> $site_logo
        ]);
    }

    public function description ($id, $description)
    {
        $invoice = Order::find($id);
        $invoice -> admin_description = $description;
        $invoice -> save();

        return redirect()->back()->with('message', 'توضیح شما برای فاکتور '.$id.'# با موفقیت ثبت شد .');
    }

    public function status ($id, $status)
    {
        $invoice = Order::find($id);
        $datetimes = json_decode($invoice -> datetimes, true);
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
        $invoice -> datetimes = json_encode($datetimes);
        $invoice -> status = $status;
        $invoice -> save();
        
        return redirect()->back()->with('message', 'وضعییت فاکتور '.$id.'# با موفقیت تغییر کرد .');
    }
}
