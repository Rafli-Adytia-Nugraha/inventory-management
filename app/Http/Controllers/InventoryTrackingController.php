<?php

namespace App\Http\Controllers;

use App\Exports\InventoryItemExport;
use App\Http\Requests\AdjustStockRequest;
use App\Models\InventoryItem;
use App\Models\StockMovement;
use Maatwebsite\Excel\Facades\Excel;

class InventoryTrackingController extends Controller
{
    public function index()
    {
        $inventoryItems = InventoryItem::with('warehouse')->filter(request(['search']))->paginate(5);

        return view('page.inventory-management.inventory-tracking.index', compact('inventoryItems'));
    }

    public function adjustStock(AdjustStockRequest $request, $id)
    {
        $inventoryItem = InventoryItem::findOrFail($id);

        $adjustment = $request['quantity'] - $inventoryItem['quantity_on_hand'];

        $inventoryItem->update(['quantity_on_hand' => $request['quantity']]);

        StockMovement::create([
            'inventory_item_id' => $id,
            'transaction_date' => now(),
            'quantity_adjusted' => $adjustment,
            'reason' => $request['reason'],
        ]);

        return redirect()->route('inventory-tracking.index')->with('success', 'Stock adjustment successfully made.');
    }

    public function viewStockMovements()
    {
        $stockMovements = StockMovement::with('inventoryItem')
            ->filter(request(['search']))
            ->orderBy('transaction_date', 'desc')
            ->paginate(5);

        return view('page.inventory-management.inventory-tracking.stock-movements', compact('stockMovements'));
    }

    public function viewAvailabilityReport()
    {
        $inventoryItems = InventoryItem::filter(request(['search']))->paginate(5);

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
