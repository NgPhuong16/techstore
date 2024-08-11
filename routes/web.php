<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{slug}', [ProductController::class, 'DetailProduct'])->name('detailproduct');

// Admin route
Route::middleware(['isAdmin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index']) -> name('admin');
    Route::get('/adminpro', [AdminController::class, 'products'])->name('admin.pro');
    Route::get('/adminadd', [AdminController::class, 'AddProForm']) -> name('adminadd');
    Route::post('/insertPro', [AdminController::class, 'InsertPro']) -> name('admin.insertpro');
    Route::get('/adminedit/{id}', [AdminController::class, 'EditProForm']) -> name('adminedit');
    Route::put('/adminedit/{id}', [AdminController::class, 'UpdatePro'])->name('admin.updatepro');
    Route::delete('/delPro/{id}', [AdminController::class, 'DeletePro']) -> name('admin.delpro');
    Route::post('/admin/search', [AdminController::class, 'Search'])->name('admin.search');
    Route::get('/admin/product/{idcate}', [AdminController::class, 'ProByCate'])->name('admin.pro.cate');

    Route::get('/admincate', [AdminController::class, 'Categories'])->name('admin.cate');
    Route::get('/adminaddcate', [AdminController::class, 'AddCateForm'])->name('admin.addcate');
    Route::post('/insertcate', [AdminController::class, 'InsertCate'])->name('admin.insertcate');
    Route::get('/admineditcate/{id}', [AdminController::class, 'EditCateForm']) -> name('admin.edit.cate');
    Route::put('/admineditcate/{id}', [AdminController::class, 'UpdateCate'])->name('admin.update.cate');
    Route::delete('/delCate/{id}', [AdminController::class, 'DeleteCate']) -> name('admin.delcate');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
