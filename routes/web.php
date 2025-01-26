<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['web'])->group(function () {
    Route::get('/login', function () {
            return view('login');
        })->name('login');
        Route::post('/login', [WebAuthController::class, 'login'])->name('login');
        Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');
        Route::middleware('auth')->group(function () {
            Route::get('/dashboard', [ProductsController::class, 'index']);
            Route::get('/add-product', [ProductsController::class, 'addProduct']);
            Route::get('/product', action: [ProductsController::class, 'index'])->name('product.index'); // GET /products
            Route::post('/product', [ProductsController::class, 'store'])->name('product.store');// POST /products
            Route::get('/product/create', [ProductsController::class, 'create'])->name('product.create'); // GET /products/create
            Route::get('/product/{product}', [ProductsController::class, 'show'])->name('product.show'); // GET /products/{product}
            Route::put('/product/{product}', [ProductsController::class, 'update'])->name('product.update'); // PUT /products/{product}
            Route::patch('/product/{product}', [ProductsController::class, 'update'])->name('product.update'); // PATCH /products/{product}
            Route::delete('/product/{product}', action: [ProductsController::class, 'destroy'])->name('product.destroy'); // DELETE /products/{product}
            Route::get('/product/{product}/edit', [ProductsController::class, 'edit'])->name('product.edit'); // GET /products/{product}/edit
            Route::post('/filter', [ProductsController::class, 'filter'])->name('filter');
            Route::get('/profile', [ProfileController::class, 'index']);
            Route::get('/export-products', [ProductsController::class, 'export'])->name('export.products');

        });
    });
