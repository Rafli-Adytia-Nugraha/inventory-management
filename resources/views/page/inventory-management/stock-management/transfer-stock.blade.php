@extends('layouts.main-layout')
@section('title', 'Inventory Management')
@section('content')
    <h1 class="mb-4">Transfer Stock</h1>
    <form action="{{ route('stock.transfer') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="item">Item Inventaris:</label>
            <select class="form-control" id="item" name="inventory_item_id" required onchange="getWarehouse()">
                @foreach ($inventoryItems as $item)
                    <option value="{{ $item->id }}" data-warehouse="{{ $item->warehouse_id }}"
                        data-warehouse-name="{{ $item->warehouse['name'] }}">{{ $item->item_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fromWarehouse">Lokasi Asal:</label>
            <input type="text" class="form-control" id="fromWarehouseName" readonly>
            <input type="hidden" id="fromWarehouseId" name="from_warehouse_id">
        </div>
        <div class="form-group">
            <label for="toWarehouse">Lokasi Tujuan:</label>
            <select class="form-control" id="toWarehouse" name="to_warehouse_id" required>
                @foreach ($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Jumlah:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="reason">Alasan Transfer:</label>
            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Transfer Stok</button>
    </form>

@endsection

@section('js')
    <script>
        function getWarehouse() {
            var itemSelect = document.getElementById('item');
            var warehouseId = itemSelect.options[itemSelect.selectedIndex].getAttribute('data-warehouse');
            var warehouseName = itemSelect.options[itemSelect.selectedIndex].getAttribute('data-warehouse-name');
            var fromWarehouseNameInput = document.getElementById('fromWarehouseName');
            var fromWarehouseIdInput = document.getElementById('fromWarehouseId');

            fromWarehouseNameInput.value = warehouseName; // Tampilkan nama warehouse
            fromWarehouseIdInput.value = warehouseId; // Set nilai ID warehouse yang akan disubmit
        }
    </script>


@endsection
