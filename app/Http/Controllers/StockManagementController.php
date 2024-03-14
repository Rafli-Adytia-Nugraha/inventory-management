<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\StockTransfer;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StockManagementController extends Controller
{
    public function transferStockForm()
    {
        $inventoryItems = InventoryItem::all();
        $warehouses = Warehouse::all();
        return view('page.inventory-management.stock-management.transfer-stock', compact('inventoryItems', 'warehouses'));
    }

    public function transferStock(Request $request)
    {
        // $request->validate([
        //     'inventory_item_id' => 'required|exists:inventory_items,id',
        //     'from_warehouse_id' => 'required|exists:warehouses,id',
        //     'to_warehouse_id' => 'required|exists:warehouses,id',
        //     'quantity' => 'required|integer|min:1',
        //     'reason' => 'required|string|max:255',
        // ]);

        $item = InventoryItem::findOrFail($request->inventory_item_id);
        $newItem = new InventoryItem();
        $newItem->item_name = $item->item_name;
        $newItem->description = $item->description;
        $newItem->quantity_on_hand = $request->quantity;
        $newItem->unit_price = $item->unit_price;
        $newItem->warehouse_id = $request->to_warehouse_id;
        $newItem->created_at = now();
        $newItem->updated_at = now();
        $newItem->save();

        // Kurangi stok dari lokasi asal
        $item->quantity_on_hand -= $request->quantity;
        $item->save();

        // Tambahkan stok ke lokasi tujuan
        // dd($request->from_warehouse_id);
        $transfer = new StockTransfer();
        $transfer->id = Str::uuid();
        $transfer->inventory_item_id = $request->inventory_item_id;
        $transfer->from_warehouse_id = $request->from_warehouse_id;
        $transfer->to_warehouse_id = $request->to_warehouse_id;
        $transfer->quantity_adjusted = $request->quantity;
        $transfer->reason = $request->reason;
        $transfer->transaction_date = now();
        $transfer->save();

        return redirect()->back()->with('success', 'Stok berhasil ditransfer.');
    }

    public function reconcileStockForm()
    {
        $inventoryItems = InventoryItem::all();
        return view('page.inventory-management.stock-management.reconcile-stock', compact('inventoryItems'));
    }

    public function reconcileStock(Request $request)
    {
        // $request->validate([
        //     'inventory_item_id' => 'required|exists:inventory_items,id',
        //     'adjusted_quantity' => 'required|integer',
        //     'reason' => 'required|string|max:255',
        // ]);

        $item = InventoryItem::findOrFail($request->inventory_item_id);

        // Rekonsiliasi stok dengan menyesuaikan jumlah stok
        $item->quantity_on_hand = $request->adjusted_quantity;
        $item->save();

        // Catat pergerakan stok
        $transfer = new StockTransfer();
        $transfer->id = Str::uuid();
        $transfer->inventory_item_id = $request->inventory_item_id;
        $transfer->from_warehouse_id = $item->warehouse_id; // Tidak ada lokasi asal karena rekonsiliasi
        $transfer->to_warehouse_id = $item->warehouse_id; // Tidak ada lokasi tujuan karena rekonsiliasi
        $transfer->quantity_adjusted = $request->adjusted_quantity;
        $transfer->reason = $request->reason;
        $transfer->transaction_date = now();
        $transfer->save();

        return redirect()->back()->with('success', 'Stok berhasil direkonsiliasi.');
    }

    public function viewStockTransfers()
    {
        $stockTransfers = StockTransfer::orderBy('created_at', 'desc')->paginate(10);

        return view('page.inventory-management.stock-management.stock-transfers', compact('stockTransfers'));
    }
}
