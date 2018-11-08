<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Slider;
use App\Http\Requests\Poster;
use App\Http\Requests\Info;
use App\Http\Requests\SocialLink;
use App\Http\Requests\ShippingCost;
use Carbon\Carbon;
use App\Classes\jdf;
use App\Option;
use App\Order;
use App\OrderProducts;
use App\Review;

class PanelController extends Controller
{
    public function index ($total_type = 'daily')
    {
        $orders = DB::select("SELECT `orders`.`id`, `users`.`first_name`, `users`.`last_name`,
            ((`shipping_cost` + `total`) - `offer`) as 'total', `status`, `orders`.`created_at`, `payment`
            FROM `orders` INNER JOIN `users` ON `orders`.`buyer` = `users`.`id`");

        $reviews = DB::select('SELECT `products`.`name`, `fullname`, `rating`, `review`, 
                `reviews`.`created_at` FROM `reviews` 
                INNER JOIN `products` ON `reviews`.`product` = `products`.`pro_id`
                ORDER BY `reviews`.`created_at` DESC LIMIT 10');

        $top_products = DB::select('SELECT `products`.`name`, COUNT(`order_products`.`product`) AS \'count\'
            FROM `order_products`
            INNER JOIN `products` ON `order_products`.`product` = `products`.`pro_id`
            INNER JOIN `orders` ON `order_products`.`order` = `orders`.`id`
            WHERE `orders`.`payment` IS NOT NULL GROUP BY products.name ORDER BY `count` DESC LIMIT 10');

        $orders_count = Order::count();

        switch ($total_type)
        {
            case 'daily':
                $total_sales = DB::select('SELECT DAY(`payment_jalali`) AS \'period\', SUM(`total` - `offer`) \'sum\'
                    FROM `orders`
                    WHERE `payment_jalali` IS NOT NULL GROUP BY DAY(`payment_jalali`) LIMIT 30'); 
                break;
            case 'weekly':
                $total_sales = DB::select('SELECT WEEK(`payment_jalali`) AS \'period\', SUM(`total` - `offer`) \'sum\'
                    FROM `orders`
                    WHERE `payment_jalali` IS NOT NULL GROUP BY WEEK(`payment_jalali`) LIMIT 20'); 
                break;
            case 'monthly':
                $total_sales = DB::select('SELECT MONTH(`payment_jalali`) AS \'period\', SUM(`total` - `offer`) \'sum\'
                    FROM `orders`
                    WHERE `payment_jalali` IS NOT NULL GROUP BY MONTH(`payment_jalali`) LIMIT 12'); 
                break;    
            case 'yearly':
                $total_sales = DB::select('SELECT YEAR(`payment_jalali`) AS \'period\', SUM(`total` - `offer`) \'sum\'
                    FROM `orders`
                    WHERE `payment_jalali` IS NOT NULL GROUP BY YEAR(`payment_jalali`) LIMIT 5'); 
                break;       
        }

        $total_income = DB::select('SELECT SUM(`total` - `offer`) AS \'sum\'
            FROM `orders` WHERE `payment_jalali` IS NOT NULL');
        $total_income = $total_income[0] -> sum;

        $product_count = DB::select('SELECT COUNT(`pro_id`) AS \'count\' FROM `products`');
        $product_count = $product_count[0] -> count;

    
        
        $options = Option::select('name', 'value')->whereIn('name', 
            ['site_name', 'site_logo', 'dollar_cost'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
                case 'dollar_cost': $dollar_cost = $option['value']; break;
            }
        }

        return view('panel.index', [
            'orders' => $orders,
            'reviews' => $reviews,
            'top_products' => $top_products,
            'orders_count' => $orders_count,
            'product_count' => $product_count,
            'page_name' => 'داشبورد',
            'total_income' => $total_income,
            'total_sales' => $total_sales,
            'total_type' => $total_type,
            'site_name'=> $site_name,
            'site_logo'=> $site_logo,
            'dollar_cost'=> $dollar_cost,
        ]);
    }

    public function setting ()
    {
        $options = Option::select('name', 'value')->whereIn('name', [
            'slider', 'posters', 'site_name', 'site_description', 'site_logo',
            'shop_phone', 'shop_address', 'social_link', 'shipping_cost'
        ])->get();
        
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'slider': $slider = json_decode($option['value'], true); break;
                case 'posters': $posters = json_decode($option['value'], true); break;
                case 'shipping_cost': $shipping_cost = json_decode($option['value'], true); break;
                case 'site_name': $site_name = $option['value']; break;
                case 'site_description': $site_description = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
                case 'shop_phone': $shop_phone = $option['value']; break;
                case 'shop_address': $shop_address = $option['value']; break;
                case 'social_link': $social_link = json_decode($option['value'], true); break;
            }
        }

        return view('panel.setting', [
            'page_name' => 'setting',
            'page_title' => 'تنظیمات',
            'slider' => $slider,
            'posters' => $posters,
            'site_name' => $site_name,
            'shipping_cost' => $shipping_cost,
            'site_description' => $site_description,
            'site_logo' => $site_logo,
            'shop_phone' => $shop_phone,
            'shop_address' => $shop_address,
            'social_link' => $social_link,
        ]);
    }

    public function slider (Slider $req)
    {
        $option = Option::select('id', 'value')->where('name', 'slider')->get();
        $option_id = $option[0]->id;
        $option_value = json_decode($option[0]->value, true);
        $slider = $req->slides;
        
        foreach ($req->slides as $key => $item) 
        {
            if (isset($item['photo']))
            {
                $file_path = public_path().'/slider/'.$option_value[$key]['photo'];
                if(file_exists($file_path)) {
                    unlink($file_path);
                }

                $photoName = substr(md5(time()), 0, 8) .'.'.$item['photo']->getClientOriginalExtension();
                $item['photo']->move(public_path('slider'), $photoName);
                
                $slider[$key]['photo'] = $photoName;
            } else {
                $slider[$key]['photo'] = $option_value[$key]['photo'];
            }
        }
        
        $slider = json_encode($slider);
        
        $option = Option::find($option_id);
        $option -> value = $slider;
        $option -> save();

        return redirect()->back()->with('message', 'اسلایدر با موفقیت بروز رسانی شد');
    }

    public function poster (Poster $req)
    {
        $option = Option::select('id', 'value')->where('name', 'posters')->get();
        $option_id = $option[0]->id;
        $option_value = json_decode($option[0]->value, true);
        $posters = $req->posters;
    
        foreach ($req->posters as $key => $item) 
        {
            if (isset($item['photo']))
            {
                $file_path = public_path().'/poster/'.$option_value[$key]['photo'];
                if(file_exists($file_path)) {
                    unlink($file_path);
                }

                $photoName = substr(md5(time()), 0, 8) .'.'.$item['photo']->getClientOriginalExtension();
                $item['photo']->move(public_path('poster'), $photoName);
                
                $posters[$key]['photo'] = $photoName;
            } else {
                $posters[$key]['photo'] = $option_value[$key]['photo'];
            }
        }
        
        $posters = json_encode($posters);
        
        $option = Option::find($option_id);
        $option -> value = $posters;
        $option -> save();

        return redirect()->back()->with('message', 'پوستر ها با موفقیت بروز رسانی شدند');
    }

    public function info (Info $req)
    {
        $option = Option::select('id', 'name', 'value')->whereIn('name', [
            'site_name', 'site_description', 'site_logo', 'shop_phone', 'shop_address'
        ])->get();

        $options = [];
        foreach ($option as $item) {
            $options[$item['name']] = ['id' => $item['id'], 'value' => $item['value']];
        }
        $info = $req->all();
        
        if (isset($info['logo']))
        {
            $file_path = public_path().'/logo/'.$options['site_logo']['value'];
            if(file_exists($file_path)) {
                unlink($file_path);
            }

            $photoName = substr(md5(time()), 0, 8) .'.'.$info['logo']->getClientOriginalExtension();
            $info['logo']->move(public_path('logo'), $photoName);
            
            $options['site_logo']['value'] = $photoName;
        }
    
        $options['site_name']['value'] = $info['site_name'];
        $options['site_description']['value'] = $info['description'];
        $options['shop_phone']['value'] = $info['phone'];
        $options['shop_address']['value'] = $info['address'];
        
        foreach ($options as $item)
        {
            $option = Option::find($item['id']);
            $option -> value = $item['value'];
            $option -> save();
        }

        return redirect()->back()->with('message', 'اطلاعات کلی با موفقیت بروز رسانی شدند');
    }

    public function social_link (SocialLink $req)
    {
        $option = Option::select('id', 'value')->where('name', 'social_link')->get();
        $option_id = $option[0] -> id;
        $option_value = json_decode($option[0] -> value, true);

        $option_value['instagram'] = $req->instagram;
        $option_value['telegram'] = $req->telegram;
        $option_value['twitter'] = $req->twitter;
        $option_value['facebook'] = $req->facebook;

        $option = Option::find($option_id);
        $option -> value = json_encode($option_value);
        $option -> save();

        return redirect()->back()->with('message', 'لینک شبکه های اجتماعی با موفقیت بروز رسانی شدند');
    }

    public function dollar_cost ($dollar_cost)
    {
        $option = Option::select('id')->where('name', 'dollar_cost')->get();
        $option = Option::find($option[0]->id);
        $option -> value = $dollar_cost;
        $option -> save();
        
        return redirect()->back()->with('message', 'قیمت دلار با موفقیت بروز رسانی شد');
    }

    public function shipping_cost (ShippingCost $req)
    {
        $option = Option::select('id', 'value')->where('name', 'shipping_cost')->get();
        $option_id = $option[0] -> id;
        $option_value = json_decode($option[0] -> value, true);

        $option_value['model1']['cost'] = $req->shipping_cost['model1'];
        $option_value['model2']['cost'] = $req->shipping_cost['model2'];
        $option_value['model3']['cost'] = $req->shipping_cost['model3'];
        $option_value['model4']['cost'] = $req->shipping_cost['model4'];

        $option = Option::find($option_id);
        $option -> value = json_encode($option_value);
        $option -> save();

        return redirect()->back()->with('message', 'هزینه های ارسال با موفقیت بروز رسانی شدند');
    }
}
