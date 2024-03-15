<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseTransactionRequest;
use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseTransaction;
use Illuminate\Http\Request;

class PurchaseTransactionController extends Controller
{
    public function store(PurchaseTransactionRequest $request)
    {
        $purchaseTransaction = PurchaseTransaction::create([
            'item_id' => $request->item_id,
            'order_id' => $request->order_id,
            'transaction_date' => $request->transaction_date,
            'quantity_purchased' => $request->quantity_purchased,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
        ]);

        return redirect()->route('purchase-transactions.index')->with('success', 'Transaksi pembelian berhasil dicatat.');
    }

    public function index()
    {
        $inventoryItems = InventoryItem::all();
        $purchaseOrders = PurchaseOrder::all();
        $purchaseTransactions = PurchaseTransaction::with('purchaseOrder', 'inventoryItem')
            ->orderBy('transaction_date', 'desc')
            ->paginate(10);

        return view('page.procurement.purchase-transactions.index', compact('purchaseTransactions', 'inventoryItems', 'purchaseOrders'));
    }

    public function update(Request $request, $id)
    {
        $purchaseTransaction = PurchaseTransaction::findOrFail($id);
        $purchaseTransaction->update([
            'item_id' => $request->item_id,
            'order_id' => $request->order_id,
            'transaction_date' => $request->transaction_date,
            'quantity_purchased' => $request->quantity_purchased,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
        ]);
        return redirect()->route('purchase-transactions.index')->with('success', 'Transaksi pembelian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $purchaseTransaction = PurchaseTransaction::findOrFail($id);
        $purchaseTransaction->delete();
        return redirect()->route('purchase-transactions.index')->with('success', 'Transaksi pembelian berhasil dihapus.');
    }
}
