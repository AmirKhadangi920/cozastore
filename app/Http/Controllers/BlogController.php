<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Brand;

class BlogController extends Controller
{
    public function index ()
    {
        return view('store.blog', [
            'articles'      => Article::with('user')->paginate(20),
            'products'      => Product::productCard(),
            'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'groups'        => $this -> Get_sub_groups(),
            'cart_products' => $this -> Get_Cart_items(),
            'brands'        => Brand::all(),
            'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => 'وبلاگ',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function show (Article $article)
    {
        return view('store.blog-single', [
            'article'      => $article,
            'products'      => Product::productCard(),
            'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'groups'        => $this -> Get_sub_groups(),
            'cart_products' => $this -> Get_Cart_items(),
            'brands'        => Brand::all(),
            'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => 'وبلاگ',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }
}
