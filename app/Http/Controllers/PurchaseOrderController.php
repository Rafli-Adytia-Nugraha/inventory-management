<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;

class PurchaseOrderController extends Controller
{
    public function create()
    {
        $suppliers = Supplier::all();
        return view('purchase_orders.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
            'total_amount' => 'required|integer',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $purchaseOrder = PurchaseOrder::create([
            'order_date' => $request->order_date,
            'delivery_date' => $request->delivery_date,
            'total_amount' => $request->total_amount,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('purchase-orders.show', $purchaseOrder->id)
            ->with('success', 'Pesanan pembelian berhasil dibuat.');
    }

    public function index()
    {
        $purchaseOrders = PurchaseOrder::orderBy('order_date', 'desc')->paginate(10);
        return view('page.procurement.purchase-orders.index', compact('purchaseOrders'));
    }

    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        return view('purchase_orders.show', compact('purchaseOrder'));
    }

    public function edit($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $suppliers = Supplier::all();
        return view('purchase_orders.edit', compact('purchaseOrder', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
            'total_amount' => 'required|integer',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrder->update([
            'order_date' => $request->order_date,
            'delivery_date' => $request->delivery_date,
            'total_amount' => $request->total_amount,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('purchase-orders.show', $purchaseOrder->id)
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
