<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function(){
 return view('layouts.master');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'customers',
                'as' => 'customer.',
                'controller' => CustomerController::class
            ],
            function () {
                Route::get('','index')->name('index');
                Route::post('store','store')->name('store');
                Route::get('edit/{customer}','edit')->name('edit');
                Route::put('update/{customer}','update')->name('update');
                Route::delete('{customer}','delete')->name('delete');
            }
        );

        Route::group(
            [
                'prefix' => 'products',
                'as' => 'product.',
                'controller' => ProductController::class
            ],
            function () {
                Route::get('', 'index')->name('index');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{product}', 'edit')->name('edit');
                Route::put('update/{product}', 'update')->name('update');
                Route::delete('{product}', 'delete')->name('delete');
            }
        );


        Route::group(
            [
                'prefix' => 'invoices',
                'as' => 'invoice.',
                'controller' => InvoiceController::class
            ],
            function () {
                Route::get('', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{invoice}', 'edit')->name('edit');
                Route::put('update/{invoice}', 'update')->name('update');
                Route::delete('{invoice}', 'delete')->name('delete');
                Route::get('{product}', 'getProduct')->name('getProduct');

            }
        );
    }

);
