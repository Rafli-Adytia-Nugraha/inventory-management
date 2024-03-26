<?php

namespace App\Http\Controllers;

use App\Http\Resources\InventoryItemResource;
use App\Models\InventoryItem;

class InventoryItemAPIController extends Controller
{
    public function index()
    {
        $items = InventoryItem::with('warehouse')->all();

        return InventoryItemResource::collection($items);
    }

    public function show($id)
    {
        $items = InventoryItem::with('warehouse')->findOrFail($id);

        return new InventoryItemResource($items);
    }
}
