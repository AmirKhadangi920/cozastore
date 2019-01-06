<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Option;
use App\Models\Order;
use Cookie;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductVariation;

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
        if ( Auth::check() && Cookie::get('cart') )
        {
            $order = Order::firstOrCreate([
                'buyer'       => Auth::user()->id,
                'status'      => 0,
            ], [
                'id'          => substr(md5( time().'_'.rand() ), 0, 8),
                'destination' => Auth::user()->state.' ، '.Auth::user()->city.' ، '.Auth::user()->address,
                'postal_code' => Auth::user()->postal_code
            ]);

            if ( $cart =  json_decode(Cookie::get('cart'), true) )
            {   
                foreach ($cart as $key => $count)
                {
                    $order->items()->updateOrCreate([
                        'variation_id' => $key,
                    ], [
                        'count'        => $count
                    ]);
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
    public static function upload_image ($image, $crop = 300, $watermark = null)
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

        if ( $watermark && file_exists( $watermark ) )
        {
            $watermark = Image::make( $watermark );
            $ratio = $watermark->width() / $watermark->height();
            $watermark->resize(50 * $ratio, 50);
            $image->insert($watermark, 'bottom-right', 10, 10);
        }

        $image->save( public_path("$file_path/$file_name.$file_ext") );
        return "/$file_path/$file_name.$file_ext";
    }

    /**
     * Get a breadcrump for specified group
     *
     * @param Integer $category
     * @return Array
     */
    public function breadcrumb (Category $category)
    {
        if ( is_null($category->parent) ) return [ $category ];
        
        $i = 1;
        $groups = [ $category ];
        do {
            $groups[$i++] = $groups[ count($groups) - 1 ]->parent_group()->first();
        } while ($groups[$i - 1]->parent);

        return $groups;
    }

    public function Get_Cart_items ( $options = [] )
    {
        // If user has logged in , get cart items from order_items table in DB
        if ( Auth::check() )
        {
            $feilds = [ 'id' ];
            $relations = [
                'items',
                'items.variation',
                'items.variation.product:id,name,photo',
                'items.variation.color:id,name,value',
                'items.variation.warranty:id,title,expire',
            ];

            if ( isset( $options['more'] ) )
            {
                $feilds = array_merge( $feilds, [
                    'discount_code_id', 'buyer_description',
                    'offer', 'shipping_cost', 'shipping_type', 'total'
                ]);
                $relations[] = 'discount_code';
            }

            return Order::select($feilds)
                ->with($relations)
                ->where('buyer', Auth::user()->id)
                ->where('status', 0)
                ->first();
        }
        // If user doesn't login , get cart items is from Cookies
        else
        {
            if ( $cart =  json_decode(Cookie::get('cart'), true) )
            {
                return ProductVariation::select([
                    'id', 'product_id', 'color_id', 'warranty_id', 'price',
                    'offer', 'unit', 'offer_deadline', 'stock_inventory'
                ])
                ->with([
                    'product:id,name,photo',
                    'color:id,name,value',
                    'warranty:id,title,expire'
                ])->whereIn('id', array_keys($cart) )
                ->get()->each( function ( $item) use ( $cart ) {
                    $item->count = $cart[ $item->id ];
                });
            }
            return [];
        }
    }

    public function Get_sub_groups ()
    {
        return Category::whereNull('parent')->with([
            'childs:id,parent,title,description',
            'childs.childs:id,parent,title,description',
            'childs.childs.childs:id,parent,title,description',
        ])->get();
    }

    public function restore_cart ()
    {
        if ( Auth::check() )
        {
            $order = Order::select('id')
                ->with([
                    'items:id,order_id,variation_id,count',
                    'items.variation:id,stock_inventory',
                ])
                ->where('buyer', Auth::user()->id)
                ->where('status', 1)->first();
            
            if ( $order )
            {
                $order->items->each( function ( $item ) {
                    $item->variation->increment('stock_inventory', $item->count);
                });

                Order::find( $order->id )->update([ 'status' => 0 ]);
            }

        }
    }
}
