<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\MenuController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RazorPayController;
use App\Http\Controllers\Staff\OrderController as StaffOrderController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\AnalyticsController;


Route::get('/', function () {
    return redirect("/login");
});

//cart

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware('customer');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view')->middleware('customer');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove')->middleware('customer');
Route::post('/cart/increase', [CartController::class, 'increase'])->name('cart.increase')->middleware('customer');
Route::post('/cart/decrease', [CartController::class, 'decrease'])->name('cart.decrease')->middleware('customer');

Route::get('/table/{table}', [MenuController::class, 'showMenu'])->middleware('customer');

//after added to cart place an order
Route::post('/order/place', [OrderController::class, 'place'])->name('order.place')->middleware('customer');



//for staff
Route::prefix('staff')->middleware(['auth', 'staff'])->group(function () {
    Route::get('/orders', [StaffOrderController::class, 'index'])->name('staff.orders');

    Route::get('/orders/history', [StaffOrderController::class, 'history'])->name('staff.history');
    

    Route::post('/orders/{order}/status', [StaffOrderController::class, 'updateStatus'])->name('staff.order.status');
    Route::get('/menu', [StaffOrderController::class, 'showMenu']);

    // ✅ latest order (for sound)
    Route::get('/orders/latest', function () {
        return Order::latest()->first();
    });

    Route::get('/orders/live', function () {
        return Order::with('table', 'items.menuItem')
            ->latest()
            ->take(10)
            ->get();
    });


    Route::post('/order/{id}/pay', [StaffOrderController::class, 'markPaid'])
        ->name('staff.order.pay');
});

Route::get('/order/{order}', [OrderController::class, 'status'])->name('order.status')->middleware('customer');

//For auto updating order status to customer
Route::get('/order/{order}/status', [OrderController::class, 'checkStatus'])->middleware('customer');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    //Authentication of Admin (Login,Logout)
    Route::resource('tables', TableController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('menu-items', MenuItemController::class);
    Route::resource('staff', StaffController::class);

    Route::get('analytics', [AnalyticsController::class, 'index'])
        ->name('admin.analytics');

    Route::post('/categories/{id}/toggle', [CategoryController::class, 'toggle'])
        ->name('categories.toggle');

    Route::post('/menu-items/{id}/toggle', [MenuItemController::class, 'toggle'])
        ->name('menu.toggle');

    Route::post('/staff/{id}/toggle', [StaffController::class, 'toggle'])->name('staff.toggle');

    Route::post('/tables/{id}/toggle', [TableController::class, 'toggle'])->name('tables.toggle');

    Route::get('/orders/history', [MenuItemController::class, 'history'])->name('orders.history');

});

Route::get('/admin/tables/{table}/qr', [TableController::class, 'downloadQR'])
    ->name('tables.qr');



//For debuges
// Route::get('/check-auth', function () {
//     return auth()->check() ? 'Logged In' : 'Guest';
// });



//for invoice generation
Route::get('/invoice/{order}', [OrderController::class, 'invoice'])->name('order.invoice')->middleware('customer');


//Authentication Breeze 
Route::get('/dashboard', function () {

    $user = auth()->user();

    $role = $user->isAdmin() ? 'admin' : 'staff';

    return view('dashboard', compact('role'));

})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__ . '/auth.php';

//Customized Login

//payment Gateway
Route::get('/razorpay', [RazorPayController::class, 'index']);
Route::get('/razorpay/payment', [RazorPayController::class, 'payment'])->name('razorpay.payment');
Route::post('/razorpay/callback', [RazorPayController::class, 'callback'])->name('razorpay.callback');

// login


Route::get('/login', [AdminLoginController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login']);

// logout
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');



