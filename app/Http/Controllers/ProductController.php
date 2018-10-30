<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateProduct;
use App\Group;
use App\Feature;
use App\Product;
use App\ProductFeatures;

class ProductController extends Controller
{
    public function index ()
    {
        return view('panel.products');
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
            $product_feature = new ProductFeatures;
            $product_feature -> product = $pro_id;
            $product_feature -> feature = $item['name'];
            $product_feature -> value = $item['value'];
            $product_feature -> save();
        }

        return redirect()->back()->with('message', 'محصول '.$req->name.' با موفقیت ثبت شد .');
    }
}
