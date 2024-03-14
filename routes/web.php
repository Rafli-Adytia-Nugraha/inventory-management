<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockManagementController;
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

// Inventory Management -> Stock Management

Route::get('/stock-management', [StockManagementController::class, 'transferStockForm'])->name('stock.transfer.form');
Route::post('/stock-management/transfer-stock', [StockManagementController::class, 'transferStock'])->name('stock.transfer');
Route::get('/stock-management/reconcile-stock', [StockManagementController::class, 'reconcileStockForm'])->name('stock.reconcile.form');
Route::post('/stock-management/reconcile-stock', [StockManagementController::class, 'reconcileStock'])->name('stock.reconcile');
Route::get('/stock-management/stock-transfers', [StockManagementController::class, 'viewStockTransfers'])->name('stock.transfers');
