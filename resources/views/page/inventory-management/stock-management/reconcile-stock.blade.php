@extends('layouts.main-layout')
@section('title', 'Inventory Management')
@section('content')
    <h1 class="mb-4">Rekonsiliasi Stok</h1>
    <form action="{{ route('stock.reconcile') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="item">Item Inventaris:</label>
            <select class="form-control" id="item" name="inventory_item_id" required>
                @foreach ($inventoryItems as $item)
                    <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="adjustedQuantity">Jumlah yang Disesuaikan:</label>
            <input type="number" class="form-control" id="adjustedQuantity" name="adjusted_quantity" required>
        </div>
        <div class="form-group">
            <label for="reason">Alasan Rekonsiliasi:</label>
            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Rekonsiliasi Stok</button>
    </form>
@endsection
