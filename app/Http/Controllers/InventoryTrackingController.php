<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\StockMovement;
use App\Exports\InventoryItemExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\AdjustStockRequest;

class InventoryTrackingController extends Controller
{
    public function index()
    {
        $inventoryItems = InventoryItem::paginate(5);
        return view('page.inventory-management.inventory-tracking.index', compact('inventoryItems'));
    }

    public function adjustStock(AdjustStockRequest $request, $id)
    {
        $inventoryItem = InventoryItem::findOrFail($id);

        $adjustment = intval($request->input('quantity'));
        $reason = $request->input('reason');

        $newQuantity = $inventoryItem->quantity_on_hand + $adjustment;
        $inventoryItem->update(['quantity_on_hand' => $newQuantity]);

        $stockMovement = new StockMovement([
            'transaction_date' => now(),
            'quantity_adjusted' => $adjustment,
            'reason' => $reason,
        ]);

        $inventoryItem->adjustments()->save($stockMovement);

        return redirect()->route('inventory-tracking.index')->with('success', 'Stock adjustment successfully made.');
    }

    public function viewStockMovements()
    {
        $stockMovements = StockMovement::with('inventoryItem')->paginate(5);

        return view('page.inventory-management.inventory-tracking.stock-movements', compact('stockMovements'));
    }

    public function viewAvailabilityReport()
    {
        $inventoryItems = InventoryItem::paginate(5);

        $totalQuantity = $inventoryItems->sum('quantity_on_hand');
        $totalValue = $inventoryItems->sum(function ($item) {
            return $item->quantity_on_hand * $item->unit_price;
        });
        $averageUnitPrice = $totalQuantity > 0 ? $totalValue / $totalQuantity : 0;

        $chartData = [
            'labels' => $inventoryItems->pluck('item_name'),
            'data' => $inventoryItems->pluck('quantity_on_hand'),
        ];

        return view('page.inventory-management.inventory-tracking.availability-reports', compact('inventoryItems', 'totalQuantity', 'averageUnitPrice', 'chartData'));

    }

    public function export()
    {
        return Excel::download(new InventoryItemExport, 'inventory_items.xlsx');
    }
}
