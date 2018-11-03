<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    public function index (Request $request)
    {
        $products = [];
        
        if (session()->has('cart'))
        {    
            $id = [];
            foreach (session()->get('cart') as $product)
            {
                $id[] = $product['id'];
            }
            
            $products = Product::select('pro_id', 'name', 'price', 'unit',
                'offer', 'photo')->whereIn('pro_id', $id)->get(); 
        }

        return view('store.shoping-cart', [
            'products' => $products,
            'dollar_cost' => 14500,
        ]);
    }
}
