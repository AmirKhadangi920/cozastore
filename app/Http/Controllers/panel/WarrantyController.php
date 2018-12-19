<?php

namespace App\Http\Controllers\panel;

use App\Warranty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'warranties' => Warranty::all()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'warranties' => Warranty::all(),
            'warranty' => $warranty
        ]);
    }

    /**
     * Update the specified Warranty in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warranty $warranty)
    {
        $warranty->update( $request->all() );
        return redirect()->back()->with('message', "گارانتی {$warranty->name} با موفقیت بروز رسانی شد");
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
        return redirect()->back()->with('message', "گارانتی {$warranty->name} با موفقیت حذف شد");
    }
}