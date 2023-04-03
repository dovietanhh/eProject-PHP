<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin',    [AdminController::class, "index"]);


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