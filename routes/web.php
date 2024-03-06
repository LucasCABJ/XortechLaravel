<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseOrderController;



Route::get('/home', [ProductController::class, 'home'])->name('home');

// RUTAS ADMIN (UserController)
Route::middleware(['auth','admin', 'active'])->group(function (){
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::delete('user/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');
    Route::put('user/reactivate/{user}', [UserController::class, 'reactivate'])->name('user.reactivate');
    Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    // TODO Estas rutas de ProductController son para el vendedor
    Route::resource('product', ProductController::class)
        ->names([
            'edit' => 'vendor.product.edit',
            'create' => 'vendor.product.create',
            'update' => 'vendor.product.update',
            'destroy' => 'vendor.product.destroy',
            'store' => 'vendor.product.store',
        ]);
    Route::get('/vendor/product/index', [ProductController::class, 'vendor'])->name('vendor.product.index');
    Route::put('/vendor/product/update/{product}', [ProductController::class, 'reactivate'])->name('vendor.product.reactivate');

    Route::post('/product/storeImages/{product}', [ProductController::class, 'storeImages'])->name('product.storeImages');

    Route::get('purchaseOrder/list', [PurchaseOrderController::class, 'list'])->name('vendor.purchase-orders.list');
    Route::get('purchaseOrder/showPending/{pendingOrder}', [PurchaseOrderController::class, 'showPending'])->name('vendor.purchase-orders.showPending');
    Route::put('/purchase-orders/{purchaseOrder}/ship', 'App\Http\Controllers\PurchaseOrderController@ship')->name('purchaseOrders.ship');
    Route::put('/purchase-orders/{purchaseOrder}/deliver', 'App\Http\Controllers\PurchaseOrderController@deliver')->name('purchaseOrders.deliver');

    //Ruta para ver las categorias para el Admin
    Route::get('vendor/category/index', [CategoryController::class, 'indexVendor'])->name('vendor.category.index');
});

// RUTAS USUARIO (UserController)
Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/user/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::put('user/update_password', [UserController::class, 'updatePassword'])->name('user.update_password');
    Route::put('user/update_email', [UserController::class, 'updateEmail'])->name('user.update_email');
    Route::put('user/update_email/{user}', [UserController::class, 'updateUserEmail'])->name('user.update_user_email');
    Route::put('user/update_pic', [UserController::class, 'updateProfilePic'])->name('user.update_profile_pic');
    Route::put('user/update_pic/{user}', [UserController::class, 'editProfilePic'])->name('user.edit_profile_pic');
    Route::put('user/update_password/{user}', [UserController::class, 'editPassword'])->name('user.edit_password');
    Route::put('user/update/{user}', [UserController::class, 'updateUser'])->name('user.update-user');
    Route::post('user/create', [UserController::class, 'create'])->name('user.create');


});

//Rutas de producto sin restricción
Route::get('/product/hero', [ProductController::class, 'heroProduct'])->name('product.heroProduct');
Route::resource('product', ProductController::class)
    ->only(['index', 'show'])
    ->names([
        'index' => 'product.index',
        'show' => 'product.show',
    ]);

// Ruta de Contacto
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');

// Rutas para Categorías
Route::resource('category', CategoryController::class);


// Rutas para el carrito de la compra
Route::get('/shoppingCart', [ShoppingCartController::class, 'index'])->name('shoppingCart.index');
Route::post('/shoppingCart/addProduct', [ShoppingCartController::class, 'addProduct'])->name('shoppingCart.addProduct');
Route::delete('/shoppingCart/deleteProduct/{shoppingCart}', [ShoppingCartController::class, 'deleteProduct'])->name('shoppingCart.deleteProduct');
Route::put('/shoppingCart/increaseQuantity/{shoppingCart}', [ShoppingCartController::class, 'increaseQuantity'])->name('shoppingCart.increaseQuantity');
Route::put('/shoppingCart/decreaseQuantity/{shoppingCart}', [ShoppingCartController::class, 'decreaseQuantity'])->name('shoppingCart.decreaseQuantity');
Route::delete('/shoppingCart/emptyCart', [ShoppingCartController::class, 'emptyCart'])->name('shoppingCart.emptyCart');
Route::post('/checkout', [ShoppingCartController::class, 'checkout'])->name('checkout');


// Rutas para la orden de compra
Route::get('/purchaseOrder/show/{purchaseOrder}', [PurchaseOrderController::class, 'show'])->name('purchase-orders.show');
Route::get('/purchaseOrder/index', [PurchaseOrderController::class, 'index'])->name('purchase-orders.index');



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');

