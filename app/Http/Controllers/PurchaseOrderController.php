<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Http\Requests\PurchaseOrderRequest;

class PurchaseOrderController extends Controller
{

    public function store(PurchaseOrderRequest $request)
    {
        $purchaseOrder = PurchaseOrder::create([
            'order_date' => $request->order_date,
            'delivery_date' => $request->delivery_date,
            'total_amount' => $request->total_amount,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('purchase-orders.index')->with('success', 'Pesanan pembelian berhasil dibuat.');
    }

    public function index()
    {
        $suppliers = Supplier::all();
        $purchaseOrders = PurchaseOrder::orderBy('order_date', 'desc')->paginate(10);
        return view('page.procurement.purchase-orders.index', compact('purchaseOrders', 'suppliers'));
    }

    public function update(PurchaseOrderRequest $request, $id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrder->update([
            'order_date' => $request->order_date,
            'delivery_date' => $request->delivery_date,
            'total_amount' => $request->total_amount,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Pesanan pembelian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrder->delete();
        return redirect()->route('purchase-orders.index')
            ->with('success', 'Pesanan pembelian berhasil dihapus.');
    }
}
