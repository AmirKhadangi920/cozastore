<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Spec\Spec;
use App\Models\ProductVariation;
use App\Models\Brand;

class CompareController extends Controller
{
    public function index ()
    {
        return view('store.compare', [
            'data'          => Spec::compare(),
            'compares'      => Product::productCard( null, [ 'products' => session('compare', []), 'more' => true ] ),
            'products'      => Product::productCard(),
            'groups'        => $this -> Get_sub_groups(),
            'top_products'  => ProductVariation::getTops(18, true),
            'cart_products' => $this -> Get_Cart_items(),
            'brands'        => Brand::all(),
            'page_title'    => 'مقایسه محصولات',
            'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'options' => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function add (Product $product)
    {
        if ( session('compare_table', null) != null && session('compare_table') != $product->spec_id )
            return redirect()->back()->withErrors(['امکان مقایسه '.$product->name.' با محصولات اضافه شده برای مقایسه ممکن نیست (گروه بندی محصول ها متفاوت است)']);

        if ( in_array( $product->id, session('compare', []) ) )
            return redirect()->back()->withErrors([$product->name.' قبلا برای مقایسه اضافه شده است']);
            
        if ( count( session('compare', []) ) > 4 )
            return redirect()->back()->withErrors(['امکان مقایسه ۴ محصول بیشتر به صورت همزمان میسر نیست']);

        
        session([
            'compare'       => array_merge(session('compare', []), [ $product->id ]),
            'compare_table' => $product->spec_id
        ]);

        return redirect()->back()->with('message', $product->name.' با موفقیت برای مقایسه اضافه شد');
    }

    public function remove (Product $product)
    {
        session(['compare' => array_diff(session('compare'), [$product->id])]);
        return redirect()->back()->with('message', $product->name.' با موفقیت از لیست مقایسه حذف شد');
    }
}
