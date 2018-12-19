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
Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'panel', 'namespace' => 'panel'], function () {
    // Dashboard Route
    Route::get('/{total_type?}', 'PanelController@index')
        ->where('total_type', 'daily|weekly|monthly|yearly');
    
    // Invoices Routes
    Route::group(['prefix' => 'invoices'], function () {

        Route::get('/', 'InvoiceController@index');
        Route::get('/{id}', 'InvoiceController@get');
        Route::get('/{id}/description/{description}', 'InvoiceController@description');
        Route::get('/{id}/status/{status}', 'InvoiceController@status');
    });
    
    // Setting Route
    Route::group(['prefix' => 'setting'], function () {

        Route::get('/', 'PanelController@setting');
        Route::post('/slider', 'PanelController@slider');
        Route::post('/posters', 'PanelController@poster');
        Route::post('/info', 'PanelController@info');
        Route::post('/social_link', 'PanelController@social_link');
        Route::post('/shipping_cost', 'PanelController@shipping_cost');
        Route::get('/dollar_cost/{dollar_cost}', 'PanelController@dollar_cost');
    });

    // Groups Route
    Route::group(['prefix' => 'group'], function () {

        Route::get('/', 'GroupController@index'); // Main group page
        Route::post('/add', 'GroupController@add'); // Send Data for create new group
        Route::post('/edit', 'GroupController@update'); // Send Data for edit exiting group
        Route::get('/delete/{id}/{title}', 'GroupController@delete'); // Send Data for delete exiting group
        Route::get('/edit/{id}/{title}', 'GroupController@edit'); // Send Data for create new group
        Route::get('/sub/{id}', 'GroupController@sub'); // Get sub group for ajax request
        Route::get('/{id}/{title}', 'GroupController@get'); // get a sub goup in panel view
    });
    
    // Get Specification Route
    Route::get('/specs/get/{id}', 'SpecsController@get'); // Send Data for edit exiting Feature
    
    // Panel Products Route
    Route::group(['prefix' => 'products'], function () {

        Route::get('/', 'ProductController@index');
        Route::get('/add', 'ProductController@add');
        Route::post('/new', 'ProductController@create');
        Route::get('/edit/{id}', 'ProductController@edit');
        Route::post('/update', 'ProductController@update');
        Route::get('/delete/{id}/{title}', 'ProductController@delete');
        Route::get('/search/{query?}', 'ProductController@search');
    });

    Route::resource('color', 'ColorController')->except([ 'create', 'show' ]);
    Route::resource('warranty', 'WarrantyController')->except([ 'create', 'show' ]);
    Route::resource('brand', 'BrandController')->except([ 'create', 'show' ]);
});

// Store Products Routes
Route::get('/', 'StoreController@index');
Route::get('/products', 'StoreController@store');
Route::post('/products/review', 'StoreController@add_review');
Route::get('/products/category/{id}', 'StoreController@category');
Route::get('/product/{id}', 'StoreController@product');
Route::get('/product/quickview/{id}', 'StoreController@quickview');

// Cart Rotes
Route::get('/cart', 'CartController@index');
Route::post('/cart/pay', 'CartController@pay')->middleware('auth');
Route::get('/cart/remove/{id}/{title}', 'CartController@remove');
Route::get('/cart/add/{id}/{title}/{count}/{color?}', 'CartController@add');
Route::get('/orders', 'InvoiceController@user_orders');

Route::get('/verify_payment', 'CartController@verify_payment');

Auth::routes();