<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuItemController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {

    Route::resource('categories', CategoryController::class);

    Route::resource('menu-items', MenuItemController::class);

});