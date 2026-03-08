<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| TIENDA (PÚBLICA)
|--------------------------------------------------------------------------
*/

Route::get('/', [ShopController::class, 'index'])->name('shop');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/products', function () {
        return Inertia::render('Products/Index');
    })->name('products');

});

Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get('/client/dashboard', function () {
        return Inertia::render('Client/Dashboard', [
            'cart' => session('cart', [])
        ]);
    })->name('client.dashboard');

});

Route::get('/checkout', function () {
    return Inertia::render('Checkout');
})->middleware('auth')->name('checkout.page');

/*
|--------------------------------------------------------------------------
| PERFIL (para todos los usuarios autenticados)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::post('/cart', [CartController::class, 'store'])->name('cart.add');

    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.remove');

});

use App\Http\Controllers\CheckoutController;

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/checkout', [CheckoutController::class, 'page'])
    ->middleware('auth')
    ->name('checkout.page');

Route::post('/orders', [OrderController::class, 'store'])->middleware('auth');

use App\Http\Controllers\Admin\ClientController;


Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/clients', [ClientController::class, 'index'])->name('clients.index');

    Route::get('/admin/clients/create', [ClientController::class, 'create'])->name('clients.create');

    Route::post('/admin/clients', [ClientController::class, 'store'])->name('clients.store');

    Route::get('/admin/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');

    Route::put('/admin/clients/{id}', [ClientController::class, 'update'])->name('clients.update');

    Route::delete('/admin/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

});

use App\Http\Controllers\Admin\ReportController;

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');

});

Route::middleware('auth')->group(function () {

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders');

    Route::post('/order/store', [OrderController::class, 'store'])
        ->name('order.store');

});

use App\Http\Controllers\Admin\SaleController;

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/sales/create', [SaleController::class, 'create'])->name('sales.create');

    Route::post('/admin/sales', [SaleController::class, 'store'])->name('sales.store');

});
/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';