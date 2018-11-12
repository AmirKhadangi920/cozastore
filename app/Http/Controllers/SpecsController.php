<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specifications;
use App\Option;

class SpecsController extends Controller
{
    public function get ($id)
    {
        $spec = Specifications::where('category', $id)->get();

        if ($spec -> all() !== []) {
            $spec = $spec[0];
        } else {
            $spec = false;
        }

        return $spec;
    }
}
