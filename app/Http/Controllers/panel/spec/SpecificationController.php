<?php

namespace App\Http\Controllers\panel\spec;

use App\Models\Spec\Spec;
use App\Http\Requests\SpeceficationRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the specifiction table.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.spec.index', [
            'specs' => Spec::latest()->with('category:id,title')->get(),
            'categories' => Category::all(),
            'page_name' => 'specification',
            'page_title' => "جداول مشخصات فنی",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new specifiction table.
     *
     * @return \Illuminate\Http\Response
     * 
     * public function create()
     * {
     *      // 
     * }
     */

    /**
     * Store a newly created specifiction table in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpeceficationRequest $request)
    {
        Spec::create([ 'category_id' => $request->parent ]);
        return redirect()->back()->with('message', "جدول مشخصات فنی با موفقیت ثبت شد");
    }

    /**
     * Display the specified specifiction table.
     *
     * @param  \App\models\spec\Spec  $specification
     * @return \Illuminate\Http\Response
     * 
     * public function show(Spec $specification)
     * {
     *    //
     * }
     */

    /**
     * Show the form for editing the specified specifiction table.
     *
     * @param  \App\models\spec\Spec  $specification
     * @return \Illuminate\Http\Response
     */
    public function edit(Spec $specification)
    {
        return view('panel.spec.index', [
            'specs' => Spec::latest()->get(),
            'spec' => $specification,
            'category' => $specification->category()->get()[0],
            'categories' => Category::all(),
            'page_name' => 'specification',
            'page_title' => "ویرایش جدول مشخصات فنی",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified specifiction table in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\spec\Spec  $specification
     * @return \Illuminate\Http\Response
     */
    public function update(SpeceficationRequest $request, Spec $specification)
    {
        $specification->update(['category_id' => $request->parent]);
        return redirect()->back()->with('message', "جدول مشخصات فنی با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified specifiction table from storage.
     *
     * @param  \App\models\spec\Spec  $specification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spec $specification)
    {
        $specification->delete();
        return redirect( route('specification.index') )->with('message', "جدول مشخصات فنی با موفقیت حذف شد");
    }
}
