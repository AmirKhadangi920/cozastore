<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cookie;
use Auth;
use App\Models\Group;
use App\Models\Feature;
use App\Models\Product;
use App\Models\ProductFeatures;
use App\Models\Review;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Spec\Spec;
use App\Models\Spec\SpecHeader;
use App\Http\Requests\AddReview;
use function Ybazli\Faker\string;
use App\Models\ProductVariation;
use App\Models\Brand;
use App\Models\Color;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Http\Resources\CartItemCollection;

class StoreController extends Controller
{
    public function index ()
    {
        $this -> restore_cart();
        $this -> move_cart_items();

        return view('store.index', [
            'products'      => Product::productCard(),
            'groups'        => $this -> Get_sub_groups(),
            'top_products'  => ProductVariation::getTops(18, true),
            'cart_products' => $this -> Get_Cart_items(),
            'brands'        => Brand::all(),
            'page_name'     => 'main',
            'offers' => [
                'the_most'    => ProductVariation::productOffers('the_most'),
                'mostـurgent' => ProductVariation::productOffers('mostـurgent'),
            ],
            'options' => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function store ($query = null)
    {
        $data = Validator::make($_GET, [
            'brand.*'    => [ 'nullable', 'integer', 'exists:brands,id' ],
            'color.*'    => [ 'nullable', 'integer', 'exists:colors,id' ],
            'price_from' => [ 'nullable', 'integer', 'min:0', 'max:10000', 'lt:price_to' ],
            'price_to'   => [ 'nullable', 'integer', 'min:0', 'max:10000', 'gt:price_from' ],
            'orderby'    => [ 'nullable' , 'in:newst,oldest,most_expensive,cheapest']
        ])->validate();

        return view('store.shop  ', [
            'products'      => Product::productCard($query, array_merge([ 'more' => true ], $data)),
            'data'          => $data,
            'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'groups'        => $this -> Get_sub_groups(),
            'cart_products' => $this -> Get_Cart_items(),
            'brands'        => Brand::all(),
            'colors'        => Color::all(),
            'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => $query ? "جستجو برای $query" : 'محصولات',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function category (Category $category)
    {
        return view('store.category  ', [
            'category'      => $category->load('childs'),
            'category_pros' => Product::productCard(null, [ 'category' => $category->id ]),
            'products'      => Product::productCard(),
            'breadcrumb'    => $this->breadcrumb($category),
            'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'groups'        => $this -> Get_sub_groups(),
            'cart_products' => $this -> Get_Cart_items(),
            'brands'        => Brand::all(),
            'colors'        => Color::all(),
            'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => 'گروه ' . $category->title,
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }
    
    public function product (Product $product)
    {
        return view('store.single-product', [
            'product'       => Product::productInfo($product, ['reviews' => true]),
            'relateds'      => Product::related_products($product),
            'products'      => Product::productCard(),
            'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'breadcrumb'    => $this->breadcrumb($product->category),
            'groups'        => $this -> Get_sub_groups(),
            'cart_products' => $this -> Get_Cart_items(),
            'brands'        => Brand::all(),
            'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => $product->name,
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function add_review (AddReview $request, Product $product)
    {
        auth()->user()->reviews()->create(
            array_merge( $request->all(), [ 'product_id' => $product->id ])
        );

        return redirect()->back()->with('message', 'نظر شما با موفقیت ثبت شد .');
    }
}
