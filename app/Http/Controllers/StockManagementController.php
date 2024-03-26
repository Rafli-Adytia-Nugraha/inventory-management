<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReconcileStockRequest;
use App\Http\Requests\TransferStockRequest;
use App\Models\InventoryItem;
use App\Models\StockTransfer;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class StockManagementController extends Controller
{
    public function transferStockForm()
    {
        $inventoryItems = InventoryItem::with('warehouse')->get();
        $warehouses = Warehouse::all();
        return view('page.inventory-management.stock-management.transfer-stock', compact('inventoryItems', 'warehouses'));
    }

    public function transferStock(TransferStockRequest $request)
    {
        $item = InventoryItem::findOrFail($request->inventory_item_id);
        $adjustedStock = $item->quantity_on_hand - $request->quantity;
        $item->update([
            'quantity_on_hand' => $adjustedStock,
        ]);

        $newItem = InventoryItem::where('warehouse_id', $request->to_warehouse_id)
            ->where('item_name', $item->item_name)
            ->first();

        if ($newItem) {
            $adjustedStock = $newItem->quantity_on_hand + $request->quantity;
            $newItem->update([
                'quantity_on_hand' => $adjustedStock,
            ]);
        } else {
            $newItem = InventoryItem::create([
                'item_name' => $item->item_name,
                'description' => $item->description,
                'quantity_on_hand' => $request->quantity,
                'unit_price' => $item->unit_price,
                'warehouse_id' => $request->to_warehouse_id,
            ]);
        }

        StockTransfer::create([
            'inventory_item_id' => $item->id,
            'from_warehouse_id' => $request->from_warehouse_id,
            'to_warehouse_id' => $request->to_warehouse_id,
            'quantity_adjusted' => $request->quantity,
            'reason' => $request->reason,
            'transaction_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Stok berhasil ditransfer.');
    }

    public function reconcileStockForm()
    {
        $inventoryItems = InventoryItem::with('warehouse')->get();

        return view('page.inventory-management.stock-management.reconcile-stock', compact('inventoryItems'));
    }

    public function reconcileStock(ReconcileStockRequest $request)
    {
        $item = InventoryItem::findOrFail($request->inventory_item_id);
        $item->update(['quantity_on_hand' => $request->adjusted_quantity]);

        StockTransfer::create([
            'inventory_item_id' => $item->id,
            'from_warehouse_id' => $item->warehouse_id,
            'to_warehouse_id' => null,
            'quantity_adjusted' => $request->adjusted_quantity,
            'reason' => $request->reason,
            'transaction_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Stok berhasil direkonsiliasi.');
    }

    public function viewStockTransfers()
    {
        $stockTransfers = StockTransfer::with(['fromWarehouse', 'toWarehouse', 'inventoryItem'])->filter(request(['search']))->orderBy('created_at', 'desc')->paginate(10);

        return view('page.inventory-management.stock-management.stock-transfers', compact('stockTransfers'));
    }
}
