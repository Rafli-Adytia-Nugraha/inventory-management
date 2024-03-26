<?php

use App\Http\Controllers\InventoryItemAPIController;
use Illuminate\Support\Facades\Route;

Route::get('/inventory-items', [InventoryItemAPIController::class, 'index']);
Route::get('/inventory-items/{id}', [InventoryItemAPIController::class, 'show']);
