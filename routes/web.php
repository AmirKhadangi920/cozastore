<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('store.index');
});

Route::get('/products', function () {
    return view('store.product');
});

Route::get('/products/{id}', function () {
    return view('store.product-detail');
});

Route::get('/contact', function () {
    return view('store.contact');
});

Route::get('/about', function () {
    return view('store.about');
});

Route::get('/blog', function () {
    return view('store.blog');
});

Route::get('/blog/{id}', function () {
    return view('store.blog-detail');
});

Route::get('/cart', function () {
    return view('store.shoping-cart');
});
