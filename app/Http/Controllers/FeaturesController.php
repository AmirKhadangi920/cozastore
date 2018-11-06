<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateFeature;
use App\Feature;
use App\Option;

class FeaturesController extends Controller
{
    public function index ()
    {
        $features = Feature::select('id', 'name')->where('title', null)->get();
        
        foreach ($features as $feature) {
            $feature->subs = Feature::select('id', 'name')->where('title', $feature->id)->get();
        }

        $options = Option::select('name', 'value')->whereIn('name', ['site_name', 'site_logo'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
            }
        }
            
        return view('panel.features', [
            'features' => $features,
            'page_name' => 'feature',
            'page_title' => 'مدیریت ویژگی ها',
            'site_name'=> $site_name,
            'site_logo'=> $site_logo
        ]);
    }

    public function add (CreateFeature $req)
    {
        Feature::create($req -> all());
        return redirect()->back()->with('message', 'ویژگی '.$req->name.' با موفقیت ثبت شد .');
    }

    public function edit ($id, $title)
    {
        $features = Feature::select('id', 'name')->where('title', null)->get();
        
        if ($features == []) { return abort(404); }

        foreach ($features as $feature) {
            $feature->subs = Feature::select('id', 'name')->where('title', $feature->id)->get();
        }

        $options = Option::select('name', 'value')->whereIn('name', ['site_name', 'site_logo'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
            }
        }

        return view('panel.features', [
            'features' => $features,
            'title' => $title,
            'id' => $id,
            'edit' => true,
            'page_name' => 'feature',
            'page_title' => 'ویرایش ویژگی ' . $title,
            'site_name'=> $site_name,
            'site_logo'=> $site_logo
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
