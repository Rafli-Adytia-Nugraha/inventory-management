@extends('layouts.dashboard')
@section('title', 'Inventory Management | Velzon')
@section('sub-title', 'Transfer Stock Movements')
@section('content')
    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">Transfer Stock</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('stock.transfer') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="item">Item Inventaris:</label>
                            <select class="form-control" id="item" name="inventory_item_id" required
                                onchange="getWarehouse()">
                                @foreach ($inventoryItems as $item)
                                    <option value="{{ $item['id'] }}" data-warehouse="{{ $item['warehouse_id'] }}"
                                        data-warehouse-name="{{ $item->warehouse['name'] }}">{{ $item['item_name'] }} - {{ $item->warehouse['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fromWarehouse">Lokasi Asal:</label>
                            <input type="text" class="form-control" id="fromWarehouseName" readonly>
                            <input type="hidden" id="fromWarehouseId" name="from_warehouse_id">
                        </div>
                        <div class="form-group mb-3">
                            <label for="toWarehouse">Lokasi Tujuan:</label>
                            <select class="form-control" id="toWarehouse" name="to_warehouse_id" required>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse['id'] }}">{{ $warehouse['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Jumlah:</span>
                            <input type="number" id="quantity" name="quantity" class="form-control" required>
                        </div>

                        <div class="form-floating">
                            <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Enter reason for transfer"></textarea>
                            <label for="reason">Alasan Transfer:</label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-soft-primary mt-4">Transfer Stok</button>
                        </div>
                    </form>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

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
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "{{ Session::get('success') }}",
                showConfirmButton: false,
                timer: 4000,
            });
        </script>
    @endif
@endsection
