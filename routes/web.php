<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomRedirectController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SSEcontroller;
use App\Http\Controllers\TestController;
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



//TEST ROUTE

Route::get('/test', [TestController::class, 'index'])->name('test-index');
Route::get('/test/items', [TestController::class, 'testItems'])->name('test-items');
Route::get('/prices', [TestController::class, 'prices'])->name('test-prices');





//Redirection
Route::middleware(['auth'])->group(function () {
    Route::get('/', [CustomRedirectController::class, 'index'])->name('admin-main');
});


    //Admin
    Route::middleware(['role:admin|operator','auth'])->group(function () {
    Route::get('/main', [AdminController::class, 'index'])->name('admin-main');
    Route::get('/orders/ajax', [AdminController::class, 'ajaxOrders'])->name('ajaxOrders');
    Route::get('/users',[AdminController::class,'users'])->name('users');
    Route::get('/admin/items',[AdminController::class,'itemsAdmin'])->name('orders');
    Route::post('/new_price',[AdminController::class,'newPrice'])->name('newPrice');
    Route::post('/order/confirm',[AdminController::class,'orderConfirm'])->name('confirm_order');
    Route::get('/order/details/{order}',[AdminController::class,'orderDetails'])->name('admin_order_details');
    Route::get('/settings',[AdminController::class,'settings'])->name('settings');
    Route::post('/sector/add',[AdminController::class,'addSector'])->name('addSector');
    Route::post('/sector/update',[AdminController::class,'sectorUpdate'])->name('sectorUpdate');
    Route::post('/users/add',[AdminController::class,'newUser'])->name('newUser');
    Route::post('/users/update',[AdminController::class,'updateUser'])->name('updateUser');
    Route::post('/users/password/update',[AdminController::class,'updatePassword'])->name('updatePassword');
    Route::post('/user/delete',[AdminController::class,'deleteUser'])->name('user_delete');
    Route::post('/items/assign',[AdminController::class,'assigments'])->name('assign_driver');
    Route::post('/user/activate',[AdminController::class,'activateUser'])->name('activateUser');
    Route::post('/user/deactivate',[AdminController::class,'deactivateUser'])->name('deactivateUser');
    //Route::post('/admin/items/update', [AdminController::class, 'editItem'])->name('admin-items-edit');
    Route::post('/admin/items/update', [OrderController::class, 'updateItem'])->name('admin-items-edit');


        Route::get('/sse',[SSEcontroller::class,'stream'])->name('stream');

        Route::post('/admin/items/delete', [OrderController::class, 'deleteItem'])->name('admin-items-delete');
    Route::post('/admin/order/delete', [OrderController::class, 'deleteOrder'])->name('admin-order-delete');
    Route::get('/payments',[BalanceController::class,'payments'])->name('payments');
    Route::get('/balance',[BalanceController::class,'balance'])->name('balance');
    Route::get('/balance/details/{customer}',[BalanceController::class,'balanceDetails'])->name('balance_details');
    Route::post('/make_payment',[BalanceController::class,'payment'])->name('make-payment');
    Route::post('/payment/delete',[BalanceController::class,'paymentDelete'])->name('payment_delete');
    Route::post('/payment/update',[BalanceController::class,'paymentUpdate'])->name('payment_update');
    Route::post('/assignments/finish/remove', [DriverController::class, 'finishRemove'])->name('item-finish-remove');

});


//Customer
Route::middleware([ 'role:customer','auth'])->group(function () {
    Route::get('/customer', [OrderController::class, 'index'])->name('customer-index');
    Route::post('/order/delete', [OrderController::class, 'deleteOrder'])->name('customer-order-delete');
    Route::get('/items', [OrderController::class, 'items'])->name('customer-items');
    Route::post('/items/delete', [OrderController::class, 'deleteItem'])->name('customer-items-delete');
    Route::post('/items/update', [OrderController::class, 'updateItem'])->name('customer-items-update');
//  Route::post('/items/edit', [OrderController::class, 'editItem'])->name('customer-items-edit');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::post('/order/update', [OrderController::class, 'orderUpdate'])->name('order_customer_update');
    Route::get('/balance/details/',[CustomerController::class,'balanceDetails'])->name('customer_balance_details');
    Route::get('/order/edit/{id}',[OrderController::class,'orderEdit'])->name('customer_order_edit');
    Route::post('/order/item/delete}',[OrderController::class,'itemDeleteCustomer'])->name('order_item_delete_bycustomer');
});



// driver
Route::middleware([ 'role:driver','auth'])->group(function () {
    Route::get('/assignments', [DriverController::class, 'index'])->name('driver-index');
    Route::post('/assignments/finish', [DriverController::class, 'finish'])->name('item-finish');
    Route::get('/assignments/finished', [DriverController::class, 'finished'])->name('item-finished');
    Route::post('/driver/comment', [DriverController::class, 'makeComment'])->name('makeComment');
    Route::post('/driver/comment/edit', [DriverController::class, 'editComment'])->name('editComment');


});