<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

//use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\HomeController;


Route::get('/home', [ProductController::class, 'home'])->name('home');

// RUTAS ADMIN (UserController)
Route::middleware(['auth','admin', 'active'])->group(function (){
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::delete('user/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');
    Route::put('user/reactivate/{user}', [UserController::class, 'reactivate'])->name('user.reactivate');
});

// RUTAS USUARIO (UserController)
Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/user/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::put('user/update_password', [UserController::class, 'updatePassword'])->name('user.update_password');
    Route::put('user/update_email', [UserController::class, 'updateEmail'])->name('user.update_profile_pic');
    Route::put('user/change_password/{user}', [UserController::class, 'changePassword'])->name('user.change_password');
    Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/update/{user}', [UserController::class, 'updateUser'])->name('user.update-user');
    Route::post('user/create', [UserController::class, 'create'])->name('user.create');

    //TODO Estas rutas de ProductController son para el vendedor
    Route::resource('product', ProductController::class)
        ->names([
            'edit' => 'product.vendor.edit',
            'create' => 'product.vendor.create',
            'update' => 'product.vendor.update',
            'destroy' => 'product.vendor.destroy',
            'store' => 'product.vendor.store',
        ]);
    Route::get('/product/vendor/index', [ProductController::class, 'vendor'])->name('product.vendor.index');

});

//Rutas de producto sin restricción
Route::resource('product', ProductController::class)
    ->only(['index', 'show'])
    ->names([
        'index' => 'product.index',
        'show' => 'product.show',
    ]);
// Rutas para Categorías
Route::resource('category', CategoryController::class);


Route::post('/product/storeImages/{product}', [ProductController::class, 'storeImages'])->name('product.storeImages');

// Rutas para el carrito de la compra
Route::get('/shoppingCart', [ShoppingCartController::class, 'index'])->name('shoppingCart.index');
Route::post('/shoppingCart/addProduct', [ShoppingCartController::class, 'addProduct'])->name('shoppingCart.addProduct');
Route::delete('/shoppingCart/deleteProduct/{shoppingCart}', [ShoppingCartController::class, 'deleteProduct'])->name('shoppingCart.deleteProduct');
Route::put('/shoppingCart/increaseQuantity/{shoppingCart}', [ShoppingCartController::class, 'increaseQuantity'])->name('shoppingCart.increaseQuantity');
Route::put('/shoppingCart/decreaseQuantity/{shoppingCart}', [ShoppingCartController::class, 'decreaseQuantity'])->name('shoppingCart.decreaseQuantity');
Route::delete('/shoppingCart/emptyCart', [ShoppingCartController::class, 'emptyCart'])->name('shoppingCart.emptyCart');

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');

