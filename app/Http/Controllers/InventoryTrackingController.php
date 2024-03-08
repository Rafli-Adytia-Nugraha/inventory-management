<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryTrackingController extends Controller
{
    public function index()
    {
        $inventoryItems = InventoryItem::paginate(5);
        return view('inventory-management.inventory-tracking.index', compact('inventoryItems'));
    }

    public function adjustStock(Request $request, $id)
    {
        $inventoryItem = InventoryItem::findOrFail($id);

        // Validasi input
        $request->validate([
            'adjustment' => 'required|numeric',
            'reason' => 'required|string',
        ]);

        // Update jumlah stok berdasarkan penyesuaian
        $adjustment = $request->input('adjustment');
        $inventoryItem->quantity_on_hand += $adjustment;
        $inventoryItem->save();

        // Catat penyesuaian stok
        $adjustmentDetails = [
            'quantity_adjusted' => $adjustment,
            'reason' => $request->input('reason'),
        ];
        $inventoryItem->adjustments()->create($adjustmentDetails);

        return redirect()->route('inventory-management.inventory-tracking.index')->with('success', 'Stock adjustment successfully made.');
    }

    public function viewStockMovements($id)
    {
        $inventoryItem = InventoryItem::findOrFail($id);
        $stockMovements = $inventoryItem->adjustments()->orderBy('created_at', 'desc')->paginate(5);
        return view('inventory-management.inventory-tracking.stock-movements', compact('inventoryItem', 'stockMovements'));
    }

    public function viewAvailabilityReport()
    {
        $inventoryItems = InventoryItem::paginate(5);
        return view('inventory-management.inventory-tracking.availability-report', compact('inventoryItems'));
    }
}
