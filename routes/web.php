<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/orders','OrderController'); //order.index
Route::resource('/products','ProductController'); //product.index
Route::resource('/suppliers','SupplierController'); //supplier.index
Route::resource('/users','UserController'); //user.index
Route::resource('/companies','CompanyController'); //company.index
Route::resource('/transactions','TransactionController'); //transaction.index

