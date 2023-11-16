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


// RUTAS USUARIO (UserController)
Route::middleware('auth')->get('/user/settings', [UserController::class, 'settings'])->name('user.settings');
Route::middleware('auth')->put('/user/update', [UserController::class, 'update'])->name('user.update');
Route::middleware('auth')->put('user/update_password', [UserController::class, 'updatePassword'])->name('user.update_password');
Route::get('user', [UserController::class, 'index'])->name('user.index');
Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('user/update/{user}', [UserController::class, 'updateUser'])->name('user.update-user');
Route::delete('user/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');
Route::put('user/reactivate/{user}', [UserController::class, 'reactivate'])->name('user.reactivate');
Route::post('user/create', [UserController::class, 'create'])->name('user.create');

Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);

Route::get('/shoppingCart', [ShoppingCartController::class, 'index'])->name('shoppingCart.index');
Route::post('/shoppingCart/addProduct', [ShoppingCartController::class, 'addProduct'])->name('shoppingCart.addProduct');
Route::delete('/shoppingCart/deleteProduct/{shoppingCart}', [ShoppingCartController::class, 'deleteProduct'])->name('shoppingCart.deleteProduct');
Route::put('/shoppingCart/increaseQuantity/{shoppingCart}', [ShoppingCartController::class, 'increaseQuantity'])->name('shoppingCart.increaseQuantity');
Route::put('/shoppingCart/decreaseQuantity/{shoppingCart}', [ShoppingCartController::class, 'decreaseQuantity'])->name('shoppingCart.decreaseQuantity');
Route::delete('/shoppingCart/emptyCart', [ShoppingCartController::class, 'emptyCart'])->name('shoppingCart.emptyCart');

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');
