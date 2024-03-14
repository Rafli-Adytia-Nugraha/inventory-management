<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InventoryTrackingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/a', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'post'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.index');

Route::get('/', function () {
    return view('layouts.main-layout');
});

// Inventory Management -> Inventory Tracking

Route::get('/inventory-tracking', [InventoryTrackingController::class, 'index'])->name('inventory-tracking.index');
Route::post('/inventory-tracking/{id}/adjust-stock', [InventoryTrackingController::class, 'adjustStock'])->name('inventory-tracking.adjust-stock');
Route::get('/inventory-tracking/stock-movements', [InventoryTrackingController::class, 'viewStockMovements'])->name('inventory-tracking.stock-movements');
Route::get('/inventory-tracking/availability-report', [InventoryTrackingController::class, 'viewAvailabilityReport'])->name('inventory-tracking.availability-report');
Route::get('/inventory-tracking/export', [InventoryTrackingController::class, 'export'])->name('inventory-tracking.export');
