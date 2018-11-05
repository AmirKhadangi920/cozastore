<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index ()
    {
        return view('panel.index');
    }

    public function setting ()
    {
        return view('panel.setting', [
            'page_name' => 'setting',
            'page_title' => 'تنظیمات'
        ]);
    }
}
