<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;


Route::get('/test', function () {
    return response()->json(['message' => 'API endpoint berhasil diakses!']);
});

// Tambahkan nama pada route login
Route::post('/login', [ApiAuthController::class, 'login'])->name('api.login');

Route::post('/logout', [ApiAuthController::class, 'logout'])->name(name: 'api.logout');
;

Route::middleware(['jwt'])->group(function () {
    Route::get('/dashboard', function () {
        return response()->json(['message' => 'Welcome to the API dashboard']);
    });
    Route::get('/profile', [ProfileController::class, 'index']);
        
    // Product Routes
    Route::get('/products', [ProductsController::class, 'index'])->name('api.products.index'); // GET /api/products
    Route::post('/products', [ProductsController::class, 'store'])->name('api.products.store'); // POST /api/products
    Route::get('/products/{product}', [ProductsController::class, 'show'])->name('api.products.show'); // GET /api/products/{id}
    Route::put('/products/{product}', [ProductsController::class, 'update'])->name('api.products.update'); // PUT /api/products/{id}
    Route::patch('/products/{product}', [ProductsController::class, 'update'])->name('api.products.update'); // PATCH /api/products/{id}
    Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('api.products.destroy'); // DELETE /api/products/{id}
    Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('api.products.edit'); // GET /api/products/{id}/edit
    Route::post('/products/filter', [ProductsController::class, 'filter'])->name('api.products.filter'); // POST /api/products/filter
    Route::get('/products/export', [ProductsController::class, 'export'])->name('api.products.export'); 
});
