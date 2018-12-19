<?php

namespace App\Http\Controllers\panel;

use App\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    /**
     * Display a listing of the colors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.color', [
            'colors' => Color::all()
        ]);
    }

    /**
     * Show the form for creating a new color.
     *
     * @return \Illuminate\Http\Response
     * 
     * public function create()
     * {
     *    //
     * }
     */

    /**
     * Store a newly created color in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Color::create( $request->all() );
        return redirect()->back()->with('message', "رنگ {$request->name} با موفقیت ثبت شد");
    }

    /**
     * Display the specified color.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     * 
     * public function show(Color $color)
     * {
     *      //
     * }
     */

    /**
     * Show the form for editing the specified color.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('panel.color', [
            'colors' => Color::all(),
            'color' => $color
        ]);
    }

    /**
     * Update the specified color in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $color->update( $request->all() );
        return redirect()->back()->with('message', "رنگ {$color->name} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified color from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->back()->with('message', "رنگ {$color->name} با موفقیت حذف شد");
    }
}
