<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\ReportController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/report', [ReportController::class, 'index'])->name('report');
Route::get('/rent', [RentController::class, 'index'])->name('rent');
Route::post('/rent', [RentController::class, 'store'])->name('rent.store');
Route::get('/rent/update/{id}', [RentController::class, 'update'])->name('Rent.update');

//customer
Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/delete/{id}', [CustomerController::class, 'destory'])->name('customer.delete');
Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
Route::post('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');

//field
Route::get('/field', [FieldController::class, 'index'])->name('field');
Route::post('/field', [FieldController::class, 'store'])->name('field.store');
Route::get('/field/delete/{id}', [FieldController::class, 'destory'])->name('field.delete');
Route::get('/field/edit/{id}', [FieldController::class, 'edit'])->name('field.edit');
Route::post('/field/update/{id}', [FieldController::class, 'update'])->name('field.update');

