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

// Admin panel Routes
Route::group(['middleware' => ['web', 'admin']], function () {
    // Dashboard Route
    Route::get('/panel', 'PanelController@index');
    
    // Invoices Routes
    Route::get('/panel/invoices', 'InvoiceController@index');
    Route::get('/panel/invoice/{id}', 'InvoiceController@get');
    Route::get('/panel/invoice/{id}/description/{description}', 'InvoiceController@description');
    Route::get('/panel/invoice/{id}/status/{status}', 'InvoiceController@status');
    
    // Setting Route
    Route::get('/panel/setting', 'PanelController@setting');

    // Gallery Route
    Route::get('/panel/gallery', 'GalleryController@index');
    Route::post('/panel/gallery/upload', 'GalleryController@upload');
    Route::get('/panel/gallery/edit/{id}', 'GalleryController@edit');
    Route::post('/panel/gallery/update', 'GalleryController@update');
    Route::get('/panel/gallery/delete/{id}/{title}/{filename}', 'GalleryController@delete');
    
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
});

// Store Products Routes
Route::get('/', 'StoreController@index');
Route::get('/products', 'StoreController@store');
Route::post('/products/review', 'StoreController@add_review');
Route::get('/products/{page?}/{order?}/{price?}/{color?}/{keyword?}/{query?}', 'StoreController@store');
Route::get('/product/{id}', 'StoreController@product');
Route::get('/product/quickview/{id}', 'StoreController@quickview');

// Cart Rotes
Route::get('/cart', 'CartController@index');
Route::get('/cart/remove/{id}/{title}', 'CartController@remove');
Route::get('/cart/add/{id}/{title}/{count}/{color?}', 'CartController@add');

Route::get('/contact', function(){return view('store.contact')->with('page_name', 'contact'); });
Route::get('/about', function(){ return view('store.about')->with('page_name', 'about'); });

Auth::routes();