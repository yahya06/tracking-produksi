<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DivisionOutputController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SizeUnitController;
use App\Models\division;
use App\Models\divisionOutput;
use App\Models\product;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/dashboard');

Route::resource('dashboard', dashboardController::class);
Route::resource('division', DivisionController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('sizeunit', SizeUnitController::class);
Route::resource('product', ProductController::class);
Route::resource('inputdivisi', DivisionOutputController::class);
Route::get('/api/products/{product}/sizes', function (product $product) {
    return $product->unitSizes; // Pastikan relasi `unitSizes` sudah diatur di model `Product`
});

Route::get('/api/orders/{productId}/{sizeUnitId}', [DivisionOutputController::class, 'getOrdersByProductAndSize']);

Route::patch('/products/{product}/complete', [ProductController::class, 'markAsCompleted'])->name('products.complete');

