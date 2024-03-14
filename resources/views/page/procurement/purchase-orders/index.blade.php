@extends('layouts.main-layout')
@section('title', 'Inventory Management')
@section('content')
    <form action="{{ route('purchase-orders.store') }}" method="POST">
        @csrf
        <div>
            <label for="order_date">Order Date:</label>
            <input type="date" id="order_date" name="order_date" required>
        </div>
        <div>
            <label for="delivery_date">Delivery Date:</label>
            <input type="date" id="delivery_date" name="delivery_date" required>
        </div>
        <div>
            <label for="total_amount">Total Amount:</label>
            <input type="number" id="total_amount" name="total_amount" required>
        </div>
        <div>
            <label for="supplier_id">Supplier:</label>
            <select id="supplier_id" name="supplier_id" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create</button>
    </form>

    <div>
        <p><strong>Order Date:</strong> {{ $purchaseOrder->order_date }}</p>
        <p><strong>Delivery Date:</strong> {{ $purchaseOrder->delivery_date }}</p>
        <p><strong>Total Amount:</strong> {{ $purchaseOrder->total_amount }}</p>
        <p><strong>Supplier:</strong> {{ $purchaseOrder->supplier->supplier_name }}</p>
    </div>

    <form action="{{ route('purchase-orders.update', $purchaseOrder->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="order_date">Order Date:</label>
            <input type="date" id="order_date" name="order_date" value="{{ $purchaseOrder->order_date }}" required>
        </div>
        <div>
            <label for="delivery_date">Delivery Date:</label>
            <input type="date" id="delivery_date" name="delivery_date" value="{{ $purchaseOrder->delivery_date }}" required>
        </div>
        <div>
            <label for="total_amount">Total Amount:</label>
            <input type="number" id="total_amount" name="total_amount" value="{{ $purchaseOrder->total_amount }}" required>
        </div>
        <div>
            <label for="supplier_id">Supplier:</label>
            <select id="supplier_id" name="supplier_id" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $purchaseOrder->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->supplier_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>

    <form action="{{ route('purchase-orders.destroy', $purchaseOrder->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <p>Are you sure you want to delete this purchase order?</p>
        <button type="submit">Delete</button>
    </form>

    <h1>Purchase Orders</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Order Date</th>
                <th>Delivery Date</th>
                <th>Total Amount</th>
                <th>Supplier</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchaseOrders as $purchaseOrder)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $purchaseOrder->order_date }}</td>
                    <td>{{ $purchaseOrder->delivery_date }}</td>
                    <td>{{ $purchaseOrder->total_amount }}</td>
                    <td>{{ $purchaseOrder->supplier->supplier_name }}</td>
                    <td>
                        <a href="{{ route('purchase-orders.show', $purchaseOrder->id) }}">View</a> |
                        <a href="{{ route('purchase-orders.edit', $purchaseOrder->id) }}">Edit</a> |
                        <form action="{{ route('purchase-orders.destroy', $purchaseOrder->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endsection