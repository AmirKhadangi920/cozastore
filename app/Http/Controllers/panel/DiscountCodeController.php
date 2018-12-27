<?php

namespace App\Http\Controllers\panel;

use App\models\DiscountCode;
use App\Http\Requests\DiscountCodeRequest;
use App\Http\Controllers\Controller;

class DiscountCodeController extends Controller
{
    /**
     * Display a listing of the Discount Codes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.discountCode', [
            'discountCodes' => DiscountCode::with('user:id,first_name,last_name')->latest()->get(),
            'page_name' => 'discountCode',
            'page_title' => 'ثبت کد تخفیف',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Discount Code.
     *
     * @return \Illuminate\Http\Response
     * 
     * public function create()
     * {
     *   //
     * }
     */

    /**
     * Store a newly created Discount Code in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountCodeRequest $request)
    {
        DiscountCode::create( $request->all() );
        return redirect()->back()->with('message', "کد تخفیف با موفقیت ثبت شد");
    }

    /**
     * Display the specified Discount Code.
     *
     * @param  \App\models\DiscountCode  $discountCode
     * @return \Illuminate\Http\Response
     * 
     * public function show(DiscountCode $discountCode)
     * {
     *   //
     * }
     */

    /**
     * Show the form for editing the specified Discount Code.
     *
     * @param  \App\models\DiscountCode  $discountCode
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscountCode $discountCode)
    {
        return view('panel.discountCode', [
            'discountCodes' => DiscountCode::latest()->get(),
            'discountCode' => $discountCode,
            'page_name' => 'discountCode',
            'page_title' => "ویرایش کد تخفیف",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified Discount Code in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\DiscountCode  $discountCode
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountCodeRequest $request, DiscountCode $discountCode)
    {
        $discountCode->update( $request->all() );
        return redirect()->back()->with('message', "کد تخفیف با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified Discount Code from storage.
     *
     * @param  \App\models\DiscountCode  $discountCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountCode $discountCode)
    {
        $discountCode->delete();
        return redirect( route('discountCode.index') )->with('message', "کد تخفیف با موفقیت حذف شد");
    }
}
