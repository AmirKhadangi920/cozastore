<?php

namespace App\Http\Controllers\panel;

use App\Models\Warranty;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarrantyRequest;

class WarrantyController extends Controller
{
    /**
     * Display a listing of the Warranties.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.warranty', [
            'warranties' => Warranty::latest()->get(),
            'page_name' => 'warranty',
            'page_title' => "گارانتی ها",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Warranty.
     *
     * @return \Illuminate\Http\Response
     * 
     * public function create()
     * {
     *   //
     * }
     */

    /**
     * Store a newly created Warranty in storage.
     *
     * @param  \App\Http\Requests\WarrantyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarrantyRequest $request)
    {
        Warranty::create( $request->all() );
        return redirect()->back()->with('message', "گارانتی {$request->name} با موفقیت ثبت شد");
    }

    /**
     * Display the specified Warranty.
     *
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     * 
     * public function show(Warranty $warranty)
     * {
     *    //
     * }
     */

    /**
     * Show the form for editing the specified Warranty.
     *
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function edit(Warranty $warranty)
    {
        return view('panel.warranty', [
            'warranties' => Warranty::latest()->get(),
            'warranty' => $warranty,
            'page_name' => 'warranty',
            'page_title' => "ویرایش گارانتی {$warranty->title}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified Warranty in storage.
     *
     * @param  \App\Http\Requests\WarrantyRequest  $request
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function update(WarrantyRequest $request, Warranty $warranty)
    {
        $warranty->update( $request->all() );
        return redirect()->back()->with('message', "گارانتی {$warranty->title} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified Warranty from storage.
     *
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warranty $warranty)
    {
        $warranty->delete();
        return redirect( route('warranty.index') )->with('message', "گارانتی {$warranty->title} با موفقیت حذف شد");
    }
}
