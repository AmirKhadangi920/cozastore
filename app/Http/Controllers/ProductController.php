<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateProduct;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\Feature;
use App\Product;
use App\ProductFeatures;

class ProductController extends Controller
{
    public function index ()
    {
        $products = Product::select('pro_id', 'name', 'code', 'price', 'unit',  'offer', 'status', 'photo')
            ->orderBy('created_at', 'DESC')->get();

        return view('panel.products', compact('products'));
    }
    
    public function add ()
    {
        $groups = Group::select('id', 'title', 'description')->where('parent', null)->get();

        $features = Feature::select('id', 'name')->where('title', null)->get();
        foreach ($features as $feature) {
            $feature->subs = Feature::select('id', 'name')->where('title', $feature->id)->get();
        }

        return view('panel.add-product', [
            'groups' => $groups,
            'features' => $features
        ]);
    }

    public function create (CreateProduct $req)
    {
        // Get a random 8 chars name for this product
        $pro_id = substr(md5(time()), 0, 8);

        // Upload product photo and hold its photo names
        $photo = ''; $gallery = '';
        if (!empty($req -> images)) {
            $res = [];
            foreach ($req -> images as $image) {
                $name = substr(md5(time() . rand()), 0, 8);
                $imageName = $name . '.' . $image->getClientOriginalExtension();
                if (empty($photo)) { $photo = $imageName; }
                $gallery .= $imageName . ',';
                $image->move(public_path('uploads/products'), $imageName);
            }
            $gallery = rtrim($gallery, ',');
        }

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
        $product->photo = $photo;
        $product->gallery = $gallery;
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
        return $product = DB::select("SELECT `pro_id`, `category`, `categories`.`title`, `products`.`name`, `code`,
            `short_description`, `aparat_video`, `price`, `unit`, `offer`, `colors`, `status`,
            `full_description`, `keywords`, `gallery`, `advantages`, `disadvantages` 
            FROM `products`
            LEFT JOIN `categories` ON `products`.`category` = `categories`.`id` WHERE `pro_id` = ?", [$id]);


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
            'product_features' => $product_feature,
            'edit' => true
        ]);
    }

    public function update (CreateProduct $req)
    {
        // Insert product details to database
        $product = Product::find($req -> id);
        $product->pro_id = $req -> id;
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
        // $product->photo = $photo;
        // $product->gallery = $gallery;
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

        return view('panel.products', compact('products'))->with('query', $query);
    }
}
