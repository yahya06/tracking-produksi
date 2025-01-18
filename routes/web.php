<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DivisionOutputController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SizeUnitController;
use App\Http\Controllers\UserController;
use App\Models\product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', '/dashboard')->middleware(['auth', 'verified']);
// Route::redirect('/', '/dashboard')->middleware(['auth', 'verified']);

// Rute untuk halaman dashboard dan lainnya (diperlukan autentikasi)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('dashboard', dashboardController::class);
    Route::resource('division', DivisionController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('sizeunit', SizeUnitController::class);
    Route::resource('product', ProductController::class);
    Route::resource('inputdivisi', DivisionOutputController::class);

    Route::get('/api/products/{product}/sizes', function (product $product) {
        return $product->unitSizes; // Pastikan relasi `unitSizes` sudah diatur di model `Product`
    });

    Route::get('/api/products/{product}', function (product $product) {
        return response()->json([
            'name_product' => $product->name_product,
            'customer' => $product->customer, // Pastikan ada relasi `customer`
        ]);
    });

    Route::get('/api/orders/{productId}/{sizeUnitId}', [DivisionOutputController::class, 'getOrdersByProductAndSize']);

    Route::patch('/products/{product}/complete', [ProductController::class, 'markAsCompleted'])->name('products.complete');

    Route::resource('users', UserController::class);

    // Route tambahan untuk assignRole
    Route::post('users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
