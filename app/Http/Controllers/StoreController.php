<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cookie;
use App\Group;
use App\Feature;
use App\Product;
use App\ProductFeatures;
use App\Review;
use App\Option;

class StoreController extends Controller
{
    public function index ()
    {
        $sql = "SELECT `pro_id`, `categories`.`id`, `categories`.`title`, `name`, `price`, `unit`,
                `offer`, `photo` FROM `products`
                LEFT JOIN `categories` ON `products`.`parent_category` = `categories`.`id`
                WHERE `status` = 1 LIMIT 30;";
        $products = DB::select($sql);

        $options = Option::select('name', 'value')->whereIn('name', [
            'slider', 'posters', 'site_name', 'site_description',
            'site_logo', 'social_link', 'dollar_cost'
        ])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'slider': $slider = json_decode($option['value'], true); break;
                case 'posters': $posters = json_decode($option['value'], true); break;
                case 'site_name': $site_name = $option['value']; break;
                case 'site_description': $site_description = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
                case 'dollar_cost': $dollar_cost = $option['value']; break;
                case 'social_link': $social_link = json_decode($option['value'], true); break;
            }
        }

        $cart_products = [];
        $cart =  json_decode(Cookie::get('cart'), true);
        if ($cart)
        {
            foreach ($cart as $key => $item)
            {
                $id[] = $item['id'];
            }
            
            $cart_products = Product::select('pro_id', 'name', 'price', 'unit',
                'offer', 'photo')->whereIn('pro_id', $id)->get(); 
        }
        
        return view('store.index  ', [
            'products' => $products,
            'dollar_cost' => $dollar_cost,
            'cart_products' => $cart_products,
            'page_name' => 'main',
            'slider' => $slider,
            'posters' => $posters,
            'site_name' => $site_name,
            'site_description' => $site_description,
            'site_logo' => $site_logo,
            'social_link' => $social_link,
        ]);
    }

    public function store ($page = 1, $order = 'newest', $price = 'all', $color = 'all', $keyword = 'all', $query = null)
    {
        $sql = "SELECT `pro_id`, `categories`.`id`, `categories`.`title`, `name`, `price`, `unit`,
                `offer`, `photo` FROM `products`
                LEFT JOIN `categories` ON `products`.`parent_category` = `categories`.`id` ";
     
        $count_sql = "SELECT count(`pro_id`) as 'count' FROM `products` ";
     
        $sql .= " WHERE `status` = 1 ";
        $count_sql .= " WHERE `status` = 1 ";
        
        if ($color && $color != 'all') { 
            $sql .= "AND `colors` LIKE '%$color%' "; 
            $count_sql .= "AND `colors` LIKE '%$color%' "; 
        }

        if ($query) {
            $sql .= "AND `name` LIKE '%$query%' "; 
            $count_sql .= "AND `name` LIKE '%$query%' "; 
        }
        
        if ($keyword && $keyword != 'all') {
            $sql .= "AND `keywords` LIKE '%$keyword%' ";
            $count_sql .= "AND `keywords` LIKE '%$keyword%' ";
        }

        switch ($price) {
            case '0to500':
                $sql .= "AND `price` < 500000 ";
                $count_sql .= "AND `price` < 500000 ";
                break;
            case '500to1000': 
                $sql .= "AND `price` BETWEEN 500000 AND 1000000 ";
                $count_sql .= "AND `price` BETWEEN 500000 AND 1000000 ";
                break;
            case '1000to2000': 
                $sql .= "AND `price` BETWEEN 1000000 AND 2000000 ";
                $count_sql .= "AND `price` BETWEEN 1000000 AND 2000000 ";
                break;
            case '2000toend': 
                $sql .= "AND `price` > 2000000 ";
                $count_sql .= "AND `price` > 2000000 ";
                break;
        }

        switch ($order) {
            case 'expensivest': $sql .= "ORDER BY `products`.`price` DESC"; break;

            case 'cheapest': $sql .= "ORDER BY `products`.`price` ASC"; break;

            case 'newest': $sql .= "ORDER BY `products`.`created_at` DESC"; break;

            case 'oldest': $sql .= "ORDER BY `products`.`created_at` ASC"; break;

            default: $sql .= "ORDER BY `products`.`created_at` DESC";
        }

        $sql .= ' LIMIT 10 OFFSET ' . ($page - 1) * 10 . ';';

        $product_count = DB::SELECT($count_sql);

        $products = DB::select($sql);

        $options = Option::select('name', 'value')->whereIn('name', 
            ['site_name', 'site_description', 'site_logo', 'social_link', 'dollar_cost'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_description': $site_description = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
                case 'dollar_cost': $dollar_cost = $option['value']; break;
                case 'social_link': $social_link = json_decode($option['value'], true); break;
            }
        }

        $cart_products = [];
        $cart =  json_decode(Cookie::get('cart'), true);
        if ($cart)
        {
            foreach ($cart as $key => $item)
            {
                $id[] = $item['id'];
            }
            
            $cart_products = Product::select('pro_id', 'name', 'price', 'unit',
                'offer', 'photo')->whereIn('pro_id', $id)->get(); 
        }
        
        return view('store.product  ', [
            'products' => $products,
            'dollar_cost' => $dollar_cost,
            'product_count' => $product_count[0]->count,
            'page' => $page,
            'cart_products' => $cart_products,
            'page_name'=> 'products',
            'page_title'=> 'محصولات',
            'site_name' => $site_name,
            'site_description' => $site_description,
            'site_logo' => $site_logo,
            'social_link' => $social_link,
            'filter' => [
                'color' => $color,
                'order' => $order,
                'price' => $price,
                'keyword' => $keyword,
                'query' => $query
            ]
        ]);
    }
    
    public function product ($id)
    {
        $product = DB::select("SELECT `pro_id`, `code`, `category`, `categories`.`title`, `products`.`name`,
            `short_description`, `aparat_video`, `price`, `unit`, `offer`, `colors`,
            `full_description`, `keywords`, `gallery`, `advantages`, `disadvantages` 
            FROM `products`
            LEFT JOIN `categories` ON `products`.`category` = `categories`.`id`
            WHERE `pro_id` = ? AND `status`=1", [$id]);

        if ($product == []) { return abort(404); }

        $product_feature = DB::select("SELECT `title_table`.`name` as 'title', `features`.`name`, `value`
            FROM `product_features`
            INNER JOIN `features` ON `product_features`.`feature` = `features`.`id`
            INNER JOIN `features` AS `title_table` ON `features`.`title` = `title_table`.`id`
            WHERE `product` = ? ORDER BY `title` ASC", [$id]);

        $reviews = Review::select('fullname', 'email', 'avatar', 'rating', 'review')->where('product', $id)->get();

        $breadcrumb = $this -> breadcrumb($product[0]->category);
        $index = count($breadcrumb);
        if (empty($breadcrumb[0])) { $index = 0; }
        $breadcrumb[$index] = [(object) [
            'parent' => null,
            'id' => $product[0] -> category,
            'title' => $product[0] -> title,
        ]];

        $options = Option::select('name', 'value')->whereIn('name', [
            'site_name', 'site_description', 'site_logo', 'social_link', 'dollar_cost'
        ])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_description': $site_description = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
                case 'dollar_cost': $dollar_cost = $option['value']; break;
                case 'social_link': $social_link = json_decode($option['value'], true); break;
            }
        }

        $cart_products = [];
        $cart =  json_decode(Cookie::get('cart'), true);
        if ($cart)
        {
            $id = [];
            foreach ($cart as $key => $item)
            {
                $id[] = $item['id'];
            }
            
            $cart_products = Product::select('pro_id', 'name', 'price', 'unit',
                'offer', 'photo')->whereIn('pro_id', $id)->get(); 
        }

        return view('store.product-detail', [
            'product' => $product[0],
            'product_features' => $product_feature,
            'breadcrumb' => $breadcrumb,
            'reviews' => $reviews,
            'cart_products' => $cart_products,
            'page_name'=> 'products',
            'dollar_cost' => $dollar_cost,
            'page_title' => $product[0]->name,
            'site_name' => $site_name,
            'site_description' => $site_description,
            'site_logo' => $site_logo,
            'social_link' => $social_link,
        ]);
    }

    public function add_review (AddReview $req)
    {
        $review = new Review();
        $review->product = $req -> product;
        $review->fullname = $req -> fullname;
        $review->email = $req -> email;
        $review->rating = $req -> rating;
        $review->review = $req -> review;

        $review -> save();

        return redirect()->back()->with('message', 'نظر شما با موفقیت ثبت شد .');
    }

    public function quickview ($id)
    {
        $data = Product::select('name', 'short_description', 'aparat_video', 'price', 'unit',
            'offer', 'colors', 'gallery')->where('pro_id', $id)->get();

        if ($data == []) { return false; }

        return json_encode($data[0]);
    }

    
    public function breadcrumb ($id)
    {
        function get_parents (&$output, $p, $i = 0) {
            $sql = "SELECT `cat1`.`parent`, `cat1`.`id`, `cat1`.`title` FROM `categories` as `cat1`
                INNER JOIN `categories` as `cat2` ON `cat1`.`id` = `cat2`.`parent` WHERE `cat2`.`id` = ?";
            
            $output[$i] = DB::select($sql, [$p]);

            if (!empty($output[$i][0]->parent)) {
                get_parents($output, $output[$i][0]->id, ++$i);
            }
        }

        $results = [];
        get_parents($results, $id);
        return $results;
    }
}
