<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\MenuController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\OrderController as StaffOrderController;

use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\StaffController;



Route::get('/', function () {
    return redirect("/login");
});




//cart

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/table/{table}', [MenuController::class, 'showMenu']);

//after added to cart place an order
Route::post('/order/place', [OrderController::class, 'place'])->name('order.place');

//for staff
Route::prefix('staff')->middleware(['auth', 'staff'])->group(function () {
    Route::get('/orders', [StaffOrderController::class, 'index'])->name('staff.orders');

    Route::post('/orders/{order}/status', [StaffOrderController::class, 'updateStatus'])->name('staff.order.status');
    Route::get('/menu', [StaffOrderController::class, 'showMenu']);

});

Route::get('/order/{order}', [OrderController::class, 'status'])->name('order.status');

//For auto updating order status to customer
Route::get('/order/{order}/status', [OrderController::class, 'checkStatus']);


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    //Authentication of Admin (Login,Logout)
    Route::resource('tables', TableController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('menu-items', MenuItemController::class);
    Route::resource('staff', StaffController::class);


});

//For debuges
// Route::get('/check-auth', function () {
//     return auth()->check() ? 'Logged In' : 'Guest';
// });



//for invoice generation
Route::get('/invoice/{order}', [OrderController::class, 'invoice'])->name('order.invoice');

//Authentication Breeze 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



