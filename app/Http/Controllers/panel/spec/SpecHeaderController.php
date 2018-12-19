<?php

namespace App\Http\Controllers\panel\spec;

use App\Models\Spec\SpecHeader;
use Illuminate\Http\Request;
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
        return $specification->specHeaders()->get();
    }

    /**
     * Show the form for creating a new specification table header.
     *
     * @param  \App\models\spec\Spec  $specification
     * @return \Illuminate\Http\Response
     */
    public function create(Spec $specification)
    {
        //
    }

    /**
     * Store a newly created specification table header in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\spec\Spec  $specification
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Spec $specification)
    {
        //
    }

    /**
     * Display the specified specification table header.
     *
     * @param  \App\models\spec\Spec  $specification
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function show(Spec $specification, SpecHeader $header)
    {
        //
    }

    /**
     * Show the form for editing the specified specification table header.
     *
     * @param  \App\models\spec\Spec  $specification
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function edit(Spec $specification, SpecHeader $header)
    {
        
    }

    /**
     * Update the specified specification table header in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\spec\Spec  $specification
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spec $specification, SpecHeader $header)
    {
        //
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
        //
    }
}
