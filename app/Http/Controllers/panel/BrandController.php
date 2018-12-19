<?php

namespace App\Http\Controllers\panel;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the Brands.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.brand', [
            'brands' => Brand::all()
        ]);
    }

    /**
     * Show the form for creating a new Brand.
     *
     * @return \Illuminate\Http\Response
     *
     * public function create()
     * {
     *   //
     * }
     */ 

    /**
     * Store a newly created brand in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Brand::create( $request->all() );
        return redirect()->back()->with('message', "برند {$request->name} با موفقیت ثبت شد");
    }

    /**
     * Display the specified brand.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     * 
     * public function show(Brand $brand)
     * {
     *   //
     * }
     */

    /**
     * Show the form for editing the specified brand.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('panel.brand', [
            'brands' => Brand::all(),
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified brand in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $brand->update( $request->all() );
        return redirect()->back()->with('message', "برند {$brand->name} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified brand from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->back()->with('message', "برند {$brand->name} با موفقیت حذف شد");
    }
}
