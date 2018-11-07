<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Product;
use App\Order;
use Cookie;
use Auth;

trait Init
{
    public function Get_Cart_items ()
    {
        if (Auth::check())
        {
            $order = Order::select('id')->where('buyer', Auth::user()->id)->where('status', 0)->get();
            if (!empty($order->all()))
            {
                return DB::select('SELECT `pro_id`, `name`, `products`.`price`,
                        `unit`, `products`.`offer`, `photo`, `color`, `count`
                        FROM `order_products` 
                        INNER JOIN `products` ON `order_products`.`product` = `products`.`pro_id`
                        WHERE `order` = ?', [$order[0]->id]);
            }
            else
            {
                return [];
            }
        }
        else
        {
            $cart =  json_decode(Cookie::get('cart'), true);
            if ($cart) {
                foreach ($cart as $key => $item) {
                    $id[] = $item['id'];
                }
                
                $cart_products = Product::select('pro_id', 'name', 'price', 'unit', 'offer', 'photo')
                        ->whereIn('pro_id', $id)->get();
                
                for ($i = 0; $i < count($cart_products); ++$i) {
                    $cart_products[$i]['color'] = null;
                    $cart_products[$i]['count'] = 1;

                    foreach ($cart as $item) {
                        if ($cart_products[$i]['pro_id'] == $item['id']) {
                            $cart_products[$i]['color'] = $item['color'];
                            $cart_products[$i]['count'] = $item['count'];
                        }
                    }
                }
                return $cart_products;
            }
            else
            {
                return [];
            }
        }
    }
}