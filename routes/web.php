<?php

use App\Http\Controllers\InventoryTrackingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseTransactionController;
use App\Http\Controllers\StockManagementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate')->middleware('throttle:authenticate');
    Route::get('/forget-password', [LoginController::class, 'forgetIndex'])->name('forget-password');
    Route::post('/forget-password', [LoginController::class, 'forgetPassword'])->name('forget-password.post');
    Route::get('/reset-password/{token}', [LoginController::class, 'resetIndex'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('reset-password.update');
    Route::get('/logout/index', [LoginController::class, 'logoutIndex'])->name('logout.index');
});

Route::middleware('auth')->group(function () {

    Route::view('/', 'page.dashboard.index')->name('dashboard');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::prefix('inventory-management')->group(function () {

        Route::prefix('inventory-tracking')->group(function () {

            Route::get('/', [InventoryTrackingController::class, 'index'])->name('inventory-tracking.index');
            Route::put('/adjust-stock/{id}', [InventoryTrackingController::class, 'adjustStock'])->name('inventory-tracking.adjust-stock');
            Route::get('/stock-movements', [InventoryTrackingController::class, 'viewStockMovements'])->name('inventory-tracking.stock-movements');
            Route::get('/availability-report', [InventoryTrackingController::class, 'viewAvailabilityReport'])->name('inventory-tracking.availability-report');
            Route::get('/export', [InventoryTrackingController::class, 'export'])->name('inventory-tracking.export');
        });

        Route::prefix('stock-management')->group(function () {

            Route::get('/', [StockManagementController::class, 'transferStockForm'])->name('stock.transfer.form');
            Route::post('/transfer-stock', [StockManagementController::class, 'transferStock'])->name('stock.transfer');
            Route::get('/reconcile-stock', [StockManagementController::class, 'reconcileStockForm'])->name('stock.reconcile.form');
            Route::post('/reconcile-stock', [StockManagementController::class, 'reconcileStock'])->name('stock.reconcile');
            Route::get('/stock-transfers', [StockManagementController::class, 'viewStockTransfers'])->name('transfers.stock.movements');
        });
    });

    Route::prefix('procurement')->group(function () {

        Route::prefix('purchase-orders')->group(function () {

            Route::get('/', [PurchaseOrderController::class, 'index'])->name('purchase-orders.index');
            Route::post('/', [PurchaseOrderController::class, 'store'])->name('purchase-orders.store');
            Route::put('/{id}', [PurchaseOrderController::class, 'update'])->name('purchase-orders.update');
            Route::delete('/{id}', [PurchaseOrderController::class, 'destroy'])->name('purchase-orders.destroy');
        });

        Route::prefix('purchase-transactions')->group(function () {

            Route::get('/', [PurchaseTransactionController::class, 'index'])->name('purchase-transactions.index');
            Route::post('/', [PurchaseTransactionController::class, 'store'])->name('purchase-transactions.store');
            Route::put('/{id}', [PurchaseTransactionController::class, 'update'])->name('purchase-transactions.update');
            Route::delete('/{id}', [PurchaseTransactionController::class, 'destroy'])->name('purchase-transactions.destroy');
        });
    });
});
