<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\MenuController;
use App\Http\Controllers\Customer\OrderController;

use App\Http\Controllers\Staff\OrderController as StaffOrderController;

use App\Http\Controllers\Admin\TableController;


Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {

    Route::resource('categories', CategoryController::class);

    Route::resource('menu-items', MenuItemController::class);

});


//cart

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/table/{table}', [MenuController::class, 'showMenu']);

//after added to cart place an order
Route::post('/order/place', [OrderController::class, 'place'])->name('order.place');

//for staff
Route::prefix('staff')->group(function () {
    Route::get('/orders', [StaffOrderController::class, 'index'])->name('staff.orders');

    Route::post('/orders/{order}/status', [StaffOrderController::class, 'updateStatus'])->name('staff.order.status');

});

Route::get('/order/{order}', [OrderController::class, 'status'])->name('order.status');

//For auto updating order status to customer
Route::get('/order/{order}/status',[OrderController::class,'checkStatus']);

//for table crud

Route::prefix('admin')->group(function () {

    Route::resource('tables', TableController::class);

});

