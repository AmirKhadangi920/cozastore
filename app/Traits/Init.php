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
                        `unit`, `products`.`offer`, `photo`, `color`, `count`, `stock_inventory`
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

    public function Get_sub_groups ()
    {
        function get_subs ($id, &$result)
        {
            if ($id)
            {
                $result = DB::select('SELECT `id`, `title` FROM `categories` WHERE `parent` = ?', [$id]);
            }
            else
            {
                $id = 0;
                $result = DB::select('SELECT `id`, `title` FROM `categories` WHERE `parent` IS NULL');
            }
        
            if ($result != [])
            {
                for ($i = 0; $i < count($result); ++$i)
                {
                    $result[$i]->subs = NULL;
                    get_subs($result[$i]->id, $result[$i]->subs);
                }
            }
        }
        
        $res = [];
        get_subs(NULL, $res);
        return $res;
    }

    public function restore_cart ()
    {
        if(\Auth::check())
        {
            $user_order = DB::select('SELECT `id` FROM `orders` WHERE `buyer` = ? AND `status` = 1', [\Auth::user()->id]);
            
            if ($user_order != [])
            {
                $order_products = OrderProducts::select('product', 'count')->where('order', $user_order[0] -> id)->get();
                foreach ($order_products as $item)
                {
                    $product = Product::find($item -> product);
                    $product -> stock_inventory = $product -> stock_inventory + $item -> count;
                    $product -> save();
                }

                $user_order = Order::find($user_order[0] -> id);
                $user_order -> status = 0;
                $user_order -> save();
            }
        }
    }
}