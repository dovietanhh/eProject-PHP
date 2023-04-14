<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/men', function () {
    return view('men');
})->name('men');
Route::get('/product_detail', function () {
    return view('product_detail');
})->name('product_detail');
Route::get('/women', function () {
    return view('women');
})->name('women');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/add_to_wishlist', function () {
    return view('add_to_wishlist');
})->name('add_to_wishlist');
Route::get('/cart', function () {
    return view('cart');
})->name('cart');
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/order_complete', function () {
    return view('order_complete');
})->name('order_complete');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');