<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateProduct;
use App\Http\Requests\AddReview;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\Feature;
use App\Product;
use App\ProductFeatures;
use App\Review;
use App\Gallery;

class ProductController extends Controller
{
    public function index ()
    {
        $products = Product::select('pro_id', 'name', 'code', 'price', 'unit',  'offer', 'status', 'photo')
            ->orderBy('created_at', 'DESC')->get();

        return view('panel.products', compact('products'))->with('page_name', 'products');
    }
    
    public function add ()
    {
        $groups = Group::select('id', 'title', 'description')->where('parent', null)->get();

        $features = Feature::select('id', 'name')->where('title', null)->get();
        foreach ($features as $feature) {
            $feature->subs = Feature::select('id', 'name')->where('title', $feature->id)->get();
        }

        $photos = Gallery::select('id', 'name', 'description', 'photo')->skip(0)->take(30)->get();

        return view('panel.add-product', [
            'groups' => $groups,
            'features' => $features,
            'photos' => $photos,
            'page_name' => 'add_product'
        ]);
    }

    public function create (CreateProduct $req)
    {
        $req->aparat_video = substr($req->aparat_video, strripos($req->aparat_video, '/') + 1);
        // Get a random 8 chars name for this product
        $pro_id = substr(md5(time()), 0, 8);

        // Insert product details to database
        $product = new Product();
        $product->pro_id = $pro_id;
        $product->category = $req -> parent;
        $product->name = $req -> name;
        $product->code = $req -> code;
        $product->short_description = $req -> short_description;
        $product->aparat_video = $req -> aparat_video;
        $product->price = $req -> price;
        $product->unit = $req -> unit;
        $product->offer = ($req->offer == null)? 0 : $req->offer;
        $product->colors = $req -> colors;
        $product->status = $req -> status;
        $product->full_description = $req -> full_description;
        $product->keywords = $req -> keywords;
        $product->photo = $req -> photo;
        $product->gallery = $req -> gallery;
        $product->advantages = $req -> advantages;
        $product->disadvantages = $req -> disadvantages;

        $product -> save();

        // Add all product features to it's table
        foreach ($req ->features as $item) {

            if ($item['name'] != 'false') {
                $product_feature = new ProductFeatures;
                $product_feature -> product = $pro_id;
                $product_feature -> feature = $item['name'];
                $product_feature -> value = $item['value'];
                $product_feature -> save();
            }
        }

        return redirect()->back()->with('message', 'محصول '.$req->name.' با موفقیت ثبت شد .');
    }

    public function edit ($id)
    {
        $product = DB::select("SELECT `pro_id`, `category`, `categories`.`title`, `products`.`name`, `code`,
            `short_description`, `aparat_video`, `price`, `unit`, `offer`, `colors`, `status`,
            `full_description`, `keywords`, `photo`, `gallery`, `advantages`, `disadvantages` 
            FROM `products`
            LEFT JOIN `categories` ON `products`.`category` = `categories`.`id` WHERE `pro_id` = ?", [$id]);

        $photos = Gallery::select('id', 'name', 'description', 'photo')
                ->whereNotIn('photo', explode(',', $product[0]->gallery))->skip(0)->take(30)->get();
            
        $product_feature = ProductFeatures::select('feature', 'value')->where('product', $id)->get();
        
        $groups = Group::select('id', 'title', 'description')->where('parent', null)->get();

        $features = Feature::select('id', 'name')->where('title', null)->get();
        foreach ($features as $feature) {
            $feature->subs = Feature::select('id', 'name')->where('title', $feature->id)->get();
        }

        return view('panel.add-product', [
            'groups' => $groups,
            'features' => $features,
            'product' => $product[0],
            'photos' => $photos,
            'product_features' => $product_feature,
            'edit' => true,
            'page_name' => 'products'
        ]);
    }

    public function update (CreateProduct $req)
    {
        $req->aparat_video = substr($req->aparat_video, strripos($req->aparat_video, '/') + 1);

        // Insert product details to database
        $product = Product::find($req -> id);
        $product->pro_id = $req -> id;
        if ($req -> parent) {
            $temp = Group::select('parent')->where('id', $req->parent)->get();
            while (!empty($temp[0])) {
                $temp = Group::select('parent')->where('id', $temp[0]->parent)->get();
                if (isset($temp[0]) && $temp[0]->parent !== null) {
                    $parent_category = $temp[0]->parent;
                }
            }   
        }
        $product->parent_category = $parent_category; 
        $product->category = $req -> parent;
        $product->name = $req -> name;
        $product->code = $req -> code;
        $product->short_description = $req -> short_description;
        $product->aparat_video = $req -> aparat_video;
        $product->price = $req -> price;
        $product->unit = $req -> unit;
        $product->offer = ($req->offer == null)? 0 : $req->offer;
        $product->colors = $req -> colors;
        $product->status = $req -> status;
        $product->full_description = $req -> full_description;
        $product->keywords = $req -> keywords;
        $product->photo = $req -> photo;
        $product->gallery = $req -> gallery;
        $product->advantages = $req -> advantages;
        $product->disadvantages = $req -> disadvantages;

        $product -> save();


        // Removes all old featuers
        DB::delete("DELETE FROM `product_features` WHERE `product` = ?", [$req->id]);

        // Add all product features to it's table
        foreach ($req ->features as $item) {

            if ($item['name'] != 'false') {
                $product_feature = new ProductFeatures;
                $product_feature -> product = $req -> id;
                $product_feature -> feature = $item['name'];
                $product_feature -> value = $item['value'];
                $product_feature -> save();
            }
        }

        return redirect()->back()->with('message', 'محصول '.$req->name.' با موفقیت بروزرسانی شد .');
    }

    public function search ($query)
    {
        $products = Product::select('pro_id', 'name', 'code', 'price', 'unit',  'offer', 'status', 'photo')
            ->orderBy('created_at', 'DESC')->where('name', 'like', '%'.$query.'%')->get();

        return view('panel.products', compact('products'))->with('query', $query)->with('page_name', 'products');
    }

    public function main ()
    {
        $sql = "SELECT `pro_id`, `categories`.`id`, `categories`.`title`, `name`, `price`, `unit`,
                `offer`, `photo` FROM `products`
                LEFT JOIN `categories` ON `products`.`parent_category` = `categories`.`id`
                WHERE `status` = 1 LIMIT 30;";

        $products = DB::select($sql);
        
        return view('store.index  ', [
            'products' => $products,
            'dollar_cost' => 14540,
            'page_name' => 'main'
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
        
        return view('store.product  ', [
            'products' => $products,
            'dollar_cost' => 14540,
            'product_count' => $product_count[0]->count,
            'page' => $page,
            'page_name'=> 'products',
            'filter' => [
                'color' => $color,
                'order' => $order,
                'price' => $price,
                'keyword' => $keyword,
                'query' => $query
            ]
        ]);
    }
    
    public function store_product ($id)
    {
        $product = DB::select("SELECT `pro_id`, `code`, `category`, `categories`.`title`, `products`.`name`,
            `short_description`, `aparat_video`, `price`, `unit`, `offer`, `colors`,
            `full_description`, `keywords`, `gallery`, `advantages`, `disadvantages` 
            FROM `products`
            LEFT JOIN `categories` ON `products`.`category` = `categories`.`id`
            WHERE `pro_id` = ? AND `status`=1", [$id]);

        $product_feature = DB::select("SELECT `title_table`.`name` as 'title', `features`.`name`, `value`
            FROM `product_features`
            INNER JOIN `features` ON `product_features`.`feature` = `features`.`id`
            INNER JOIN `features` AS `title_table` ON `features`.`title` = `title_table`.`id`
            WHERE `product` = ? ORDER BY `title` ASC", [$id]);

        $reviews = Review::select('fullname', 'email', 'avatar', 'rating', 'review')->where('product', $id)->get();

        $breadcrumb = $this -> breadcrumb($product[0]->category);
        $breadcrumb[] = [(object) [
            'parent' => null,
            'id' => $product[0] -> category,
            'title' => $product[0] -> title,
        ]];

        return view('store.product-detail', [
            'product' => $product[0],
            'product_features' => $product_feature,
            'breadcrumb' => $breadcrumb,
            'reviews' => $reviews,
            'page_name'=> 'products',
            'dollar_cost' => 14540
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
