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
    Route::resource('category', 'CategoryController');
    Route::get('group/sub/{id}', 'CategoryController@sub'); // Get sub group for ajax request
    
    // Get Specification Route
    Route::get('/specs/get/{id}', 'SpecsController@get'); // Send Data for edit exiting Feature
    
    
    // Panel Products Route
    Route::resource('product', 'ProductController')->except([ 'show' ]);
    Route::get('/product/search/{query?}', 'ProductController@search');

    Route::resource('specification', 'Spec\SpecificationController')->except([ 'create', 'show' ]);
    Route::group(['prefix' => 'specification/{specification}'], function () {
        Route::resource('header', 'Spec\SpecHeaderController')->except([ 'create', 'show' ]);
    });
    Route::group(['prefix' => 'specification/header/{header}'], function () {
        Route::resource('row', 'Spec\SpecRowController')->except([ 'create', 'show' ]);
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
Route::get('/orders', 'panel\InvoiceController@user_orders');

Route::get('/verify_payment', 'CartController@verify_payment');

Auth::routes();