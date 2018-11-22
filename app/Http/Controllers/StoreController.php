<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cookie;
use Auth;
use App\Group;
use App\Feature;
use App\Product;
use App\ProductFeatures;
use App\Review;
use App\Option;
use App\Order;
use App\OrderProducts;
use App\Traits\Init;

class StoreController extends Controller
{
    use Init;

    public function index ()
    {
        $this -> restore_cart();
        

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

        $sql = "SELECT `pro_id`, `categories`.`id`, `categories`.`title`, `name`, `price`, `unit`,
                `offer`, `photo`, `stock_inventory`, `label` 
                FROM `products`
                LEFT JOIN `categories` ON `products`.`parent_category` = `categories`.`id`
                WHERE `status` = 1 ORDER BY `products`.`created_at` DESC LIMIT 30;";
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

        return view('store.index  ', [
            'products' => $products,
            'top_groups' => $this -> Get_sub_groups(),
            'dollar_cost' => $dollar_cost,
            'cart_products' => $this -> Get_Cart_items(),
            'page_name' => 'main',
            'slider' => $slider,
            'posters' => $posters,
            'site_name' => $site_name,
            'site_description' => $site_description,
            'site_logo' => $site_logo,
            'social_link' => $social_link,
        ]);
    }

    public function store ()
    {
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $order = (isset($_GET['order'])) ? $_GET['order'] : 'newest';
        $price = (isset($_GET['price'])) ? $_GET['price'] : 'all';
        $color = (isset($_GET['color'])) ? $_GET['color'] : 'all';
        $keyword = (isset($_GET['keyword'])) ? $_GET['keyword'] : 'all';
        $query = (isset($_GET['query'])) ? $_GET['query'] : null;
        $category = (isset($_GET['category'])) ? $_GET['category'] : null;

        $sql = "SELECT `pro_id`, `categories`.`id`, `categories`.`title`, `name`, `price`, `unit`,
                `offer`, `photo`, `label`, `stock_inventory` 
                FROM `products`
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
        
        if ($category)
        {
            function get_parent ($id, &$groups_id)
            {
                $groups_id[] = $id;
                $group = Group::select('id', 'title')->where('parent', $id)->get();
                if ($group->all() != [])
                {
                    foreach ($group as $item)
                    {
                        get_parent($item->id, $groups_id);
                    }
                } else {
                    $groups_id = [];
                }
            }
            
            $x = []; get_parent($category, $x); $x = implode(',', $x);
            if ($x)
            {
                $sql .= "AND `category` IN ($x) "; 
                $count_sql .= "AND `category` IN ($x) ";
            }
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
            default:
                $price = 'all';
        }

        switch ($order) {
            case 'expensivest': $sql .= "ORDER BY `products`.`price` DESC"; break;

            case 'cheapest': $sql .= "ORDER BY `products`.`price` ASC"; break;

            case 'newest': $sql .= "ORDER BY `products`.`created_at` DESC"; break;

            case 'oldest': $sql .= "ORDER BY `products`.`created_at` ASC"; break;

            default: $sql .= "ORDER BY `products`.`created_at` DESC";
        }

        $sql .= ' LIMIT 10 OFFSET ' . ($page - 1) * 30 . ';';
        
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

        $page_title = (isset($_GET['category_name'])) ? 'محصولات گروه '.$_GET['category_name'] : 'محصولات';

        $breadcrumb = [];

        if (isset($_GET['category']))
        {
            $breadcrumb = $this -> breadcrumb($_GET['category']);
        }

        return view('store.product  ', [
            'products' => $products,
            'top_groups' => $this -> Get_sub_groups(),
            'dollar_cost' => $dollar_cost,
            'product_count' => $product_count[0]->count,
            'page' => $page,
            'breadcrumb' => $breadcrumb,
            'cart_products' => $this -> Get_Cart_items(),
            'page_name'=> 'products',
            'page_title'=> $page_title,
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
        $product = DB::select("SELECT `pro_id`, `code`, `products`.`category`, `categories`.`title`,
            `products`.`name`, `short_description`, `aparat_video`, `price`, `unit`, `offer`, 
            `colors`, `label`, `stock_inventory`, `specs`, `specifications`, `full_description`,
            `keywords`, `gallery`, `advantages`, `disadvantages`
            FROM `products`
            LEFT JOIN `categories` ON `products`.`category` = `categories`.`id`
            LEFT JOIN `specifications` ON `products`.`spec_table` = `specifications`.`id`
            WHERE `pro_id` = ? AND `status`=1", [$id]);

        if ($product == []) { return abort(404); }

        $reviews = Review::select('fullname', 'email', 'avatar', 'rating', 'review')->where('product', $id)->get();

        $breadcrumb = $this -> breadcrumb($product[0]->category);
        $index = count($breadcrumb) - 1;
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

        return view('store.product-detail', [
            'product' => $product[0],
            'top_groups' => $this -> Get_sub_groups(),
            'breadcrumb' => $breadcrumb,
            'reviews' => $reviews,
            'cart_products' => $this -> Get_Cart_items(),
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
