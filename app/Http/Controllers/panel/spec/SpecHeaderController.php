<?php

namespace App\Http\Controllers\panel\spec;

use App\Models\Spec\SpecHeader;
use App\Http\Requests\SpecHeaderRequest;
use App\Http\Controllers\Controller;
use App\Models\Spec\Spec;

class SpecHeaderController extends Controller
{
    /**
     * Display a listing of the specification table header.
     *
     * @param  \App\models\spec\Spec  $specification
     * @return \Illuminate\Http\Response
     */
    public function index(Spec $specification)
    {
        return view('panel.spec.header', [
            'specification' => $specification,
            'headers' => $specification->specHeaders()->get(),
            'page_name' => 'specification',
            'page_title' => "عناوین جدول {$specification->category()->get()[0]->title}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new specification table header.
     *
     * @param  \App\models\spec\Spec  $specification
     * @return \Illuminate\Http\Response
     * 
     * public function create(Spec $specification)
     * {
     *   //
     * }
     */

    /**
     * Store a newly created specification table header in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\spec\Spec  $specification
     * @return \Illuminate\Http\Response
     */
    public function store(SpecHeaderRequest $request, Spec $specification)
    {
        $specification->specHeaders()->create( $request->all() );
        return redirect()->back()->with('message', "عنوان {$request->title} برای جدول 
                    {$specification->category()->get()[0]->title} با موفقیت ثبت شد");
    }

    /**
     * Display the specified specification table header.
     *
     * @param  \App\models\spec\Spec  $specification
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     * 
     * public function show(Spec $specification, SpecHeader $header)
     * {
     *    //
     * }
     */

    /**
     * Show the form for editing the specified specification table header.
     *
     * @param  \App\models\spec\Spec  $specification
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function edit(Spec $specification, SpecHeader $header)
    {
        return view('panel.spec.header', [
            'specification' => $specification,
            'headers' => $specification->specHeaders()->get(),
            'header' => $header,
            'page_name' => 'specification',
            'page_title' => "ویرایش {$header->title}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified specification table header in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\spec\Spec  $specification
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function update(SpecHeaderRequest $request, Spec $specification, SpecHeader $header)
    {
        $header->update( $request->all() );
        return redirect()->back()->with('message', "عنوان {$header->title} در جدول 
                    {$specification->category()->get()[0]->title} با موفقیت بروزرسانی شد");
    }

    /**
     * Remove the specified specification table header from storage.
     *
     * @param  \App\models\spec\Spec  $specification
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spec $specification, SpecHeader $header)
    {
        $header->delete();
        
        return redirect(route('header.index', [ 'specification' => $specification->id ]))
            ->with('message', "عنوان {$header->title} در جدول 
                    {$specification->category()->get()[0]->title} با موفقیت حذف شد");
    }
}
