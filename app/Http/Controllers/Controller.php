<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Option;
use Cookie;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function options ($items)
    {
        return Option::select('name', 'value')
            ->whereIn('name', $items)
            ->get()
            ->keyBy('name')
            ->map(function ($item) {
                if ( in_array($item['name'] , [ 'slider', 'posters', 'social_link', 'shipping_cost' ]) )
                {
                    return json_decode( $item['value'] );
                }
                return $item['value'];
            });
    }

    public static function move_cart_items ()
    {
        if (\Auth::check() && Cookie::get('cart'))
        {
            $order = Order::select('id')->where('buyer',\Auth::user()->id)->where('status', 0)->get();
            
            if (!empty($order->all()))
            {
                $order_id = $order[0]->id;
            }
            else
            {
                $order = new Order();
                $order -> id = substr(md5(time()), 0, 8);
                $order -> buyer = Auth::user()->id;
                $order -> destination = Auth::user()->state.' ، '.Auth::user()->city.' ، '.Auth::user()->address;
                $order -> postal_code = Auth::user()->postal_code;
                $order -> save();

                $order_id = $order -> id;
            }

            $cart =  json_decode(Cookie::get('cart'), true);
            if (!empty($cart))
            {   
                foreach ($cart as $item)
                {           
                    if (Product::find($item['id']))
                    {
                        $order_product = new OrderProducts();
                        $order_product -> order = $order_id;
                        $order_product -> product = $item['id'];
                        $order_product -> color = $item['color'];
                        $order_product -> count = $item['count'];
                        $order_product -> save();
                    }         
                }
                Cookie::queue('cart', NULL, -1);
            }
        }
    }

    /**
     * Upload an image to public path
     *
     * @param File $image
     * @return String file_name
     */
    public static function upload_image ($image, $crop = 300)
    {
        // Create file name & file path with /year/month/day/filename formats
        $time = Carbon::now();   
        $file_path = "uploads/{$time->year}/{$time->month}/{$time->day}";
        $file_ext = $image->getClientOriginalExtension();
        $file_name = rtrim($image->getClientOriginalName(), ".$file_ext");
        $file_name = time() . '_' . substr($file_name, 0, 30);
        
        // Create directories if doesn't exists
        if (!file_exists( public_path($file_path) )) {
            mkdir(public_path($file_path), 0777, true);
        }
        
        // Reszie and upload the image to storge
        $image = Image::make( $image );
        $image->resize($crop, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save( public_path("$file_path/$file_name.$file_ext") );
        return "/$file_path/$file_name.$file_ext";
    }
}
