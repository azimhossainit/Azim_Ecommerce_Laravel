<?php
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::controller(AdminController::class)->group(function() {
    Route::get('/', 'index')->name('admin.root');
});

// Load admin routes correctly
require __DIR__.'/admin.php';

