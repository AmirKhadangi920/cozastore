<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;

class PanelController extends Controller
{
    public function index ()
    {
        $options = Option::select('name', 'value')->whereIn('name', ['site_name', 'site_logo'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
            }
        }

        return view('panel.index', [
            'page_name' => 'داشبورد',
            'site_name'=> $site_name,
            'site_logo'=> $site_logo
        ]);
    }

    public function setting ()
    {
        $options = Option::select('name', 'value')->whereIn('name', [
            'slider', 'posters', 'site_name', 'site_description', 'site_logo',
            'shop_phone', 'shop_address', 'social_link'
        ])->get();
        
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'slider': $slider = json_decode($option['value'], true); break;
                case 'posters': $posters = json_decode($option['value'], true); break;
                case 'site_name': $site_name = $option['value']; break;
                case 'site_description': $site_description = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
                case 'shop_phone': $shop_phone = $option['value']; break;
                case 'shop_address': $shop_address = $option['value']; break;
                case 'social_link': $social_link = json_decode($option['value'], true); break;
            }
        }

        return view('panel.setting', [
            'page_name' => 'setting',
            'page_title' => 'تنظیمات',
            'slider' => $slider,
            'posters' => $posters,
            'site_name' => $site_name,
            'site_description' => $site_description,
            'site_logo' => $site_logo,
            'shop_phone' => $shop_phone,
            'shop_address' => $shop_address,
            'social_link' => $social_link,
        ]);
    }
}
