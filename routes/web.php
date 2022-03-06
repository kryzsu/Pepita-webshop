<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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



Route::get('/about', function () {return view('about');})->name('about');


Route::get('/products', [ProductsController::class,'index'])->name('products');
Route::get('/products/create', [ProductsController::class,'create']);
Route::get('/products/search', [ProductsController::class,'search'])->name('search');
Route::get('/products/order', [ProductsController::class,'order'])->name('order');
Route::get('/products/cart', [ProductsController::class,'cart'] )->name('cart');
Route::get('/products/checkout', [ProductsController::class,'checkout'] )->name('checkout');
Route::get('/addToCart/{id?}', [ProductsController::class,'getAddToCart'] )->name('addToCart');
Route::post('/products', [ProductsController::class,'store'] );
Route::delete('/products/cart/{id}', [ProductsController::class,'destroy'] )->name('destroy');
Route::delete('/products/order/{id}', [ProductsController::class,'destroyOrder'] )->name('destroyOrder');
Route::get('/products/{id?}', [ProductsController::class,'show'] );

Auth::routes();


Route::get('/home', [App\Http\Controllers\ProductsController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\ProductsController::class, 'index'])->name('home');

