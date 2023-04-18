<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShoesCategoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class,"index"]);

Route::get('/dashboard',    [AdminController::class, "index"]);
Route::get('/AdminLogin',    [AdminController::class, "Beforelogin"]);
Route::post('/afterLogin',    [AdminController::class, "login"]);
Route::get('/logoutAdmin',    [AdminController::class, "logoutAdmin"]);



//category
Route::get('/admin/categories/showCategory',    [CategoryController::class, "showListCategory"]);
Route::get('/editCategory/{id}',    [CategoryController::class, "editCategory"]);
Route::get('/admin/categories/addcategory',    [CategoryController::class, "addCategory"]);

Route::post('/admin/categories/saveCategory',    [CategoryController::class, "saveCategory"]);
Route::patch('/admin/categories/updateCategory/{id}',    [CategoryController::class, "updateCategory"]);
Route::delete('/admin/categories/deleteCategory/{id}',    [CategoryController::class, "deleteCategory"]);


//brand
Route::get('/admin/brands/showBrand',    [BrandController::class, "index"]);
Route::get('/admin/brands/editBrand/{id}',    [BrandController::class, "edit"]);
Route::get('/admin/brands/addBrand',    [BrandController::class, "create"]);

Route::post('/admin/brands/saveBrand',    [BrandController::class, "store"]);
Route::patch('/admin/brands/updateBrand/{id}',    [BrandController::class, "update"]);
Route::delete('/admin/brands/deleteBrand/{id}',    [BrandController::class, "destroy"]);

//shoes

Route::get('/admin/shoes/showShoes',    [ShoesCategoryController::class, "index"]);
Route::get('/admin/shoes/editShoes/{id}',    [ShoesCategoryController::class, "edit"]);
Route::get('/admin/shoes/addShoes',    [ShoesCategoryController::class, "create"]);

Route::post('/admin/shoes/saveShoes',    [ShoesCategoryController::class, "store"]);
Route::patch('/admin/shoes/updateShoes/{id}',    [ShoesCategoryController::class, "update"]);
Route::delete('/admin/shoes/deleteShoes/{id}',    [ShoesCategoryController::class, "destroy"]);

//employees

Route::get('/admin/employees/showEmployees',    [EmployeeController::class, "index"]);
Route::get('/admin/employees/editEmployee/{id}',    [EmployeeController::class, "edit"]);
Route::get('/admin/employees/addEmployee',    [EmployeeController::class, "create"]);

Route::post('/admin/employees/saveEmployee',    [EmployeeController::class, "store"]);
Route::patch('/admin/employees/updateEmployee/{id}',    [EmployeeController::class, "update"]);
Route::delete('/admin/employees/deleteEmployee/{id}',    [EmployeeController::class, "destroy"]);

//role
Route::post("/admin/employees/update_roles/{id}",[AdminController::class,"updateRole"]);






//employees

Route::get('/admin/customers/showCustomers',    [CustomerController::class, "index"]);
Route::delete('/admin/customers/deleteCustomer/{id}',    [CustomerController::class, "destroy"]);



//order 

Route::get('/admin/orderdetails/showOrderdetail',    [OrderController::class, "index"]);
// <<<<<<< HEAD:routes/web.php
Route::delete('/admin/orderdetails/deleteOrderdetail/{id}',    [OrderController::class, "destroy"]);
// =======
Route::delete('/admin/orderdetails/deleteOrderdetail/{id}',    [CustomerController::class, "destroy"]);

//Men Page
Route::get('/men', function () {
    return view('client.men');
})->name('men');

//Product Detail Page
Route::get('/product_detail', function () {
    return view('client.product_detail');
})->name('product_detail');

//Women Page
Route::get('/women', function () {
    return view('client.women');
})->name('women');

//About Page
Route::get('/about', function () {
    return view('client.about');
})->name('about');

//Add to wishlist Page
Route::get('/add_to_wishlist', function () {
    return view('client.add_to_wishlist');
})->name('add_to_wishlist');

//Cart Page
Route::get('/cart', function () {
    return view('client.cart');
})->name('cart');

//Checkout Page
Route::get('/checkout', function () {
    return view('client.checkout');
})->name('checkout');

//Contact Page
Route::get('/contact', function () {
    return view('client.contact');
})->name('contact');

//detail_product
Route::get('/detail-product/{id}',[HomeController::class,"ProductDetai"]);


//Order Complete Page
Route::get('/order_complete', function () {
    return view('client.order_complete');
})->name('order_complete');

//Home Page
Route::get('/welcome', [HomeController::class,"index"]);
// >>>>>>> 1b91cd5de4c098db1d90469263b80cee649e8b7f:Đông/routes/web.php
