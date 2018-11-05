<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateFeature;
use App\Feature;

class FeaturesController extends Controller
{
    public function index ()
    {
        $features = Feature::select('id', 'name')->where('title', null)->get();
        
        foreach ($features as $feature) {
            $feature->subs = Feature::select('id', 'name')->where('title', $feature->id)->get();
        }

        return view('panel.features', compact('features'))->with('page_name', 'feature')
            ->with('page_title', 'مدیریت ویژگی ها');
    }

    public function add (CreateFeature $req)
    {
        Feature::create($req -> all());
        return redirect()->back()->with('message', 'ویژگی '.$req->name.' با موفقیت ثبت شد .');
    }

    public function edit ($id, $title)
    {
        $features = Feature::select('id', 'name')->where('title', null)->get();
        
        foreach ($features as $feature) {
            $feature->subs = Feature::select('id', 'name')->where('title', $feature->id)->get();
        }

        return view('panel.features', [
            'features' => $features,
            'title' => $title,
            'id' => $id,
            'edit' => true,
            'page_name' => 'feature',
            'page_title' => 'ویرایش ویژگی ' . $title
        ]);
    }

    public function update (CreateFeature $req)
    {
        Feature::where('id', $req->id)->update([
            'name' => $req->name,
        ]);
        return redirect()->back()->with('message', 'ویژگی '.$req->title.' با موفقیت بروز رسانی شد .');
    }

    public function delete ($id, $title)
    {
        Feature::destroy($id);
        return redirect()->back()->with('message', 'ویژگی '.$title.' با موفقیت حذف شد .');
    }
}
