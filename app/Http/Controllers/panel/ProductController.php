<?php

namespace App\Http\Controllers\panel;

use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Warranty;
use App\Models\ProductVariation;
use App\Models\Spec\SpecData;
use App\Models\Spec\SpecRow;
use Morilog\Jalali\Jalalian;
use Cookie;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.products', [
            'products' => Product::productCard(),
            'page_name' => 'products',
            'page_title' => 'محصولات',
            'options'=> $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.add-product', [
            'groups' => Category::first_levels(),
            'colors' => Color::latest()->get(),
            'brands' => Brand::latest()->get(),
            'warranties' => Warranty::latest()->get(),
            'page_name' => 'add_product',
            'page_title' => 'ثبت محصول',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $images = $this->upload($request->images);
        
        $product = auth()->user()->products()->create( array_merge($request->except('parent', 'brand', 'variations'), [
            'id' => substr(md5(time()), 0, 8),
            'image' => ( isset($images[0]) ) ? $images[0] : null,
            'gallery' => $images,
            'brand_id' => $request->brand,
            'category_id' => $request->parent,
            'aparat_video' => ($request->aparat_video) ? substr($request->aparat_video, strripos($request->aparat_video, '/') + 1) : null
        ]));

        $variation = $request->variations[0];
        $product->variations()->create(array_merge($variation, [
            'id' => substr(md5(time()), 0, 8),
            'color_id' => $variation['color'],
            'warranty_id' => $variation['warranty'],
            'offer' => ( $variation['offer'] ) ? $variation['offer'] : 0 ,
            'stock_inventory' => ( $variation['stock_inventory'] ) ? $variation['stock_inventory'] : 0,
        ]));

        return redirect()->action(
            'panel\ProductController@edit', ['id' => $product->id]
        )->with('message', 'محصول '.$product->name.' با موفقیت ثبت شد .');
    }

    /**
     * Display the specified product.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     * 
     * public function show(Product $product)
     * {
     *    //
     * }
     */

    /**
     * Show the form for editing the specified product.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // return Product::productInfo($product);

        if ( is_null($product->spec_id) )
        {
            if ($product->category_id) 
            {
                $spec = Category::findOrFail($product->category_id)->specs()->first();
                if ($spec == [])
                    $spec = Category::findOrFail($product->category_id)->parent()->first()->specs()->first();

                if ( $spec != [] )
                    $product->update([ 'spec_id' => $spec->id ]);
            }
        }
        
        // return SpecRow::find(2331);
        // return Product::productInfo($product);

        return view('panel.add-product', [
            'product'     => Product::productInfo($product),
            'groups'      => Category::first_levels(),
            'colors'      => Color::latest()->get(),
            'brands'      => Brand::latest()->get(),
            'warranties'  => Warranty::latest()->get(),
            'page_name'   => 'products',
            'page_title'  => 'ویرایش محصول ',
            'options'     => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $images = $product->gallery;
        if ($request->deleted_images)
        {
            $deleted = json_decode($request->deleted_images, true);
            foreach ($deleted as $img)
            {
                $temp = public_path( $img );
                if(file_exists($temp)) unlink($temp);
                if (($key = array_search($img, $images)) !== false) unset($images[$key]);
            }
        }
        
        $images = array_merge( $this->upload($request->images), $images );
        
        $product->update( array_merge($request->except('parent', 'brand', 'variations', 'specs'), [
            'image' => ( isset($images[0]) ) ? $images[0] : null,
            'gallery' => $images,
            'brand_id' => $request->brand,
            'category_id' => $request->parent,
            'aparat_video' => ($request->aparat_video) ? substr($request->aparat_video, strripos($request->aparat_video, '/') + 1) : null
        ]));

        if ( $request->specs )
        {
            foreach ( $request->specs as $key => $item )
            {
                if ( isset( $item['id'] ) )
                {
                    SpecData::findOrFail($item['id'])->update(array_merge($item, [
                        'data' => (gettype($item['data']) == 'array') ? implode(',', $item['data']) : $item['data']
                    ]));
                }
                elseif ( isset($item['data']) && $item['data'] )
                {
                    SpecRow::find($key)->specData()->create(array_merge($item, [
                        'product_id' => $product->id,
                        'data' => (gettype($item['data']) == 'array') ? implode(',', $item['data']) : $item['data'] 
                    ]));
                }
            }
        }

        foreach ( $request->variations as $item )
        {
            if ( isset( $item['id'] ) )
            {
                ProductVariation::findOrFail($item['id'])->update(array_merge($item, [
                    'color_id' => $item['color'],
                    'warranty_id' => $item['warranty'],
                    'offer' => ( $item['offer'] ) ? $item['offer'] : 0 ,
                    'stock_inventory' => ( $item['stock_inventory'] ) ? $item['stock_inventory'] : 0,
                ]));
            }
            elseif ( $item['price'] )
            {
                $product->variations()->create(array_merge($item, [
                    'id' => substr(md5(time()), 0, 8),
                    'color_id' => $item['color'],
                    'warranty_id' => $item['warranty'],
                    'offer' => ( $item['offer'] ) ? $item['offer'] : 0 ,
                    'stock_inventory' => ( $item['stock_inventory'] ) ? $item['stock_inventory'] : 0,
                ]));
            }
        }

        return redirect()->back()->with('message', 'محصول '.$product->name.' با موفقیت بروزرسانی شد .');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect( route('product.index') )->with('message', 'محصول '.$product->title.' با موفقیت حذف شد .');
    }

    /**
     * Show the filtered products from storage.
     *
     * @param  String  $query
     * @return \Illuminate\Http\Response
     */
    public function search ($query = '')
    {
        return view('panel.products', [
            'products' => Product::productCard($query),
            'page_name' => 'products',
            'query' => $query,
            'page_title' => 'جستجوی محصولات برای "' . $query . '"',
            'options'=> $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Upload the image and insert watermark on it
     *
     * @param File $images
     * @return Array
     */
    public function upload ($input)
    {
        if ($input != [])
        {
            $images = [];
            $watermark = $this->options(['watermark'])['watermark'];
            foreach (Input::file('images') as $photo)
            {
                $images[] = $this->upload_image($photo, 500, public_path('logo/' . $watermark) );
            }
            return $images;
        }
        else
        {
            return [];
        }
    }
}
