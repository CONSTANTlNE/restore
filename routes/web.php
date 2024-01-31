<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomRedirectController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
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


Route::get('/orders', function () {

    return Order::all()->pluck('order')->first();
});

Route::get('/order', function () {
    $id=uniqid("",false);
    return $id;
});

//Redirection
Route::middleware(['auth'])->group(function () {
    Route::get('/', [CustomRedirectController::class, 'index'])->name('admin-main');
});

//Admin
Route::middleware(['role:admin','auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin-main');
    Route::get('/orders/ajax', [AdminController::class, 'ajaxOrders'])->name('ajaxOrders');
    Route::get('/users',[AdminController::class,'users'])->name('users');
    Route::get('/orders',[AdminController::class,'orders'])->name('orders');
    Route::get('/settings',[AdminController::class,'settings'])->name('settings');
    Route::post('/sector/add',[AdminController::class,'addSector'])->name('addSector');
    Route::post('/users/add',[AdminController::class,'newUser'])->name('newUser');
    Route::post('/items/assign',[AdminController::class,'assigments'])->name('assign_driver');

});


//Customer
Route::middleware([ 'role:customer','auth'])->group(function () {
    Route::get('/customer', [OrderController::class, 'index'])->name('customer-index');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
});

