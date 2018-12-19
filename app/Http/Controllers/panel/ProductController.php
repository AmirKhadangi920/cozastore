<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProduct;
use App\Http\Requests\AddReview;
use Illuminate\Support\Facades\DB;
use Cookie;
use App\Models\Feature;
use App\Models\Option;
use App\Models\Product;
use App\Models\ProductFeatures;
use App\Models\Review;
use App\Models\Category;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index ()
    {
        return view('panel.products', [
            'products' => Product::productCard(),
            'page_name' => 'products',
            'page_title' => 'محصولات',
            'options'=> $this->options(['site_name', 'site_logo'])
        ]);
    }
    
    public function add ()
    {
        return view('panel.add-product', [
            'groups' => Category::first_levels(),
            'page_name' => 'add_product',
            'page_title' => 'ثبت محصول',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    public function create (CreateProduct $req)
    {
        $images = [];

        if ($req -> images != [])
        {
            $site_logo = Option::select('value')->where('name', 'site_logo')->get();
            foreach (Input::file('images') as $photo)
            {
                $img = Image::make($photo)->resize(500, 500);
    
                $watermark = Image::make(public_path('logo/' . $site_logo[0]->value));
                $ratio = $watermark->width() / $watermark->height();
                $watermark->resize(50 * $ratio, 50);
                $img->insert($watermark, 'bottom-right', 10, 10);
                
                $name = substr(md5(time() . rand()), 0, 8);
                $imageName = $name . '.' . $photo->getClientOriginalExtension();
                $images[] = $imageName;
                $img->save(public_path('uploads/') . $imageName);
            }
        }

        if ($req->aparat_video) $req->aparat_video = substr($req->aparat_video, strripos($req->aparat_video, '/') + 1);

        if ($req -> parent) {
            $temp = Group::select('parent')->where('id', $req->parent)->get();
            while (!empty($temp[0])) {
                $temp = Group::select('parent')->where('id', $temp[0]->parent)->get();
                if (isset($temp[0]) && $temp[0]->parent !== null) {
                    $parent_category = $temp[0]->parent;
                    $product->parent_category = $parent_category; 
                }
            }   
        }
        
        $data = array_merge( $req->all(), [
            'id' => substr(md5(time()), 0, 8),
            'category' => $req->parent,
            'offer' => ($req->offer == null)? 0 : $req->offer,
            'image' => ( isset($images[0]) ) ? $images[0] : null,
            'gallery' => json_encode($images),
            'stock_inventory' => ($req->stock_inventory == null)? 0 : $req->stock_inventory,
        ]);
        unset($data['parent']);
        // Insert product details to database
        $product = Product::create( $data );

        return redirect()->action(
            'ProductController@edit', ['id' => $product->id]
        )->with('message', 'محصول '.$product->name.' با موفقیت ثبت شد .');
    }

    public function edit ($id)
    {
        return view('panel.add-product', [
            'groups'        => Category::first_levels(),
            'product'       => Product::productInfo($id),
            'edit'          => true,
            'page_name'     => 'products',
            'page_title'    => 'ویرایش محصول ',
            'options'       => $this->options(['site_name', 'site_logo']) 
        ]);
    }

    public function update (CreateProduct $req)
    {
        $images = json_decode(Product::find($req->id)->gallery, true);
        $deleted = json_decode($req -> deleted_images, true);
        
        foreach ($deleted as $img)
        {
            $temp = public_path('uploads/' . $img);
            if(file_exists($temp)) unlink($temp);
            if (($key = array_search($img, $images)) !== false) unset($images[$key]);
        }
    
        if ($req -> images != [])
        {
            $site_logo = Option::select('value')->where('name', 'site_logo')->get();
            foreach (Input::file('images') as $photo)
            {
                $img = Image::make($photo)->resize(500, 500);
    
                $watermark = Image::make(public_path('logo/' . $site_logo[0]->value));
                $ratio = $watermark->width() / $watermark->height();
                $watermark->resize(50 * $ratio, 50);
                $img->insert($watermark, 'bottom-right', 10, 10);
                
                $name = substr(md5(time() . rand()), 0, 8);
                $imageName = $name . '.' . $photo->getClientOriginalExtension();
                $images[] = $imageName;
                $img->save(public_path('uploads/') . $imageName);
            }
        }

        if ($req->aparat_video) $req->aparat_video = substr($req->aparat_video, strripos($req->aparat_video, '/') + 1);

        // Insert product details to database
        $product = Product::find($req -> id);
        if ($req -> parent) {
            $temp = Group::select('parent')->where('id', $req->parent)->get();
            while (!empty($temp[0])) {
                $temp = Group::select('parent')->where('id', $temp[0]->parent)->get();
                if (isset($temp[0]) && $temp[0]->parent !== null) {
                    $parent_category = $temp[0]->parent;
                    $product->parent_category = $parent_category; 
                }
            }   
        }
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
        $product -> label = $req -> label;
        $product->full_description = $req -> full_description;
        $product->keywords = $req -> keywords;
        $product -> photo = ( isset($images[0]) ) ? $images[0] : null;
        $product -> gallery = json_encode($images);
        $product -> stock_inventory = ($req->stock_inventory == null)? 0 : $req->stock_inventory;
        $product -> spec_table = $req -> spec_id;
        $product -> specifications = json_encode($req->specs);
        $product->advantages = $req -> advantages;
        $product->disadvantages = $req -> disadvantages;

        $product -> save();

        return redirect()->back()->with('message', 'محصول '.$req->name.' با موفقیت بروزرسانی شد .');
    }

    public function delete (Product $id, $title)
    {
        $id->delete();
        return redirect()->back()->with('message', 'محصول '.$title.' با موفقیت حذف شد .');
    }

    public function search ($query = '')
    {

        $products = Product::select('pro_id', 'name', 'code', 'price', 'unit',  'offer', 'status', 'photo')
            ->orderBy('created_at', 'DESC');
        if ($query != '') {
            $products->where('name', 'like', '%'.$query.'%');
        }
        $products =$products->get();
        
        $options = Option::select('name', 'value')->whereIn('name', ['site_name', 'site_logo'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
            }
        }


        // return $products;
        return view('panel.products', [
            'products' => $products,
            'query' => $query,
            'page_name' => 'products',
            'page_title' => 'جستجوی محصولات برای "' . $query . '"',
            'site_name'=> $site_name,
            'site_logo'=> $site_logo
        ]);
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
