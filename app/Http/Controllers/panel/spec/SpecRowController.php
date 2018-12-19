<?php

namespace App\Http\Controllers\panel\spec;

use App\Models\Spec\SpecRow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Spec\SpecHeader;

class SpecRowController extends Controller
{
    /**
     * Display a listing of the specification table rows.
     *
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function index(SpecHeader $header)
    {
        //
    }

    /**
     * Show the form for creating a new specification table row.
     *
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function create(SpecHeader $header)
    {
        //
    }

    /**
     * Store a newly created specification table row in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SpecHeader $header)
    {
        //
    }

    /**
     * Display the specified specification table row.
     *
     * @param  \App\models\spec\SpecHeader  $header
     * @param  \App\models\spec\SpecRow  $specRow
     * @return \Illuminate\Http\Response
     */
    public function show(SpecHeader $header, SpecRow $specRow)
    {
        //
    }

    /**
     * Show the form for editing the specified specification table row.
     *
     * @param  \App\models\spec\SpecHeader  $header
     * @param  \App\models\spec\SpecRow  $specRow
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecHeader $header, SpecRow $specRow)
    {
        //
    }

    /**
     * Update the specified specification table row in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\spec\SpecHeader  $header
     * @param  \App\models\spec\SpecRow  $specRow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpecHeader $header, SpecRow $specRow)
    {
        //
    }

    /**
     * Remove the specified specification table row from storage.
     *
     * @param  \App\models\spec\SpecHeader  $header
     * @param  \App\models\spec\SpecRow  $specRow
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecHeader $header, SpecRow $specRow)
    {
        //
    }
}
