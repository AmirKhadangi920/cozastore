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

Route::get('/panel', function () {
    return view('panel.index');
});


// Groups Route
Route::get('/panel/group', 'GroupController@index'); // Main group page
Route::post('/panel/group/add', 'GroupController@add'); // Send Data for create new group
Route::post('/panel/group/edit', 'GroupController@update'); // Send Data for edit exiting group
Route::get('/panel/group/delete/{id}/{title}', 'GroupController@delete'); // Send Data for delete exiting group
Route::get('/panel/group/edit/{id}/{title}', 'GroupController@edit'); // Send Data for create new group
Route::get('/panel/group/sub/{id}', 'GroupController@sub'); // Get sub group for ajax request
Route::get('/panel/group/{id}/{title}', 'GroupController@get'); // get a sub goup in panel view

// Features Route
Route::get('/panel/feature', 'FeaturesController@index'); // Main features page
Route::post('/panel/feature/add', 'FeaturesController@add'); // Send data for create new feature
Route::get('/panel/feature/edit/{id}/{title}', 'FeaturesController@edit'); // Send Data for edit exiting Feature
Route::post('/panel/feature/edit', 'FeaturesController@update'); // Send Data for edit exiting Feature
Route::get('/panel/feature/delete/{id}/{title}', 'FeaturesController@delete'); // Send Data for edit exiting Feature

// Panel Products Route
Route::get('/panel/products', 'ProductController@index');
Route::get('/panel/products/add', 'ProductController@add');
Route::post('/panel/products/new', 'ProductController@create');
Route::get('/panel/products/edit/{id}', 'ProductController@edit');
Route::post('/panel/products/update', 'ProductController@update');
Route::get('/panel/products/search/{query}', 'ProductController@search');
// Store Products Route
Route::get('/products', 'ProductController@store');
Route::get('/products/{id}', 'ProductController@store_product');
Route::post('/products/review', 'ProductController@add_review');
