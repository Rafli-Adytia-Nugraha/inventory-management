@extends('layouts.dashboard')
@section('title', 'Inventory Management | Velzon')
@section('sub-title', 'Reconcile Stock')
@section('content')
    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">Rekonsiliasi Stok</h4>
                </div><!-- end cardheader -->
                <div class="card-body">
                    <form action="{{ route('stock.reconcile') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="item">Item Inventaris:</label>
                            <select class="form-control" id="item" name="inventory_item_id" required>
                                @foreach ($inventoryItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->item_name }} - {{ $item->warehouse['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="adjustedQuantity">Jumlah yang Disesuaikan:</label>
                            <input type="number" class="form-control" id="adjustedQuantity" name="adjusted_quantity"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="reason">Alasan Rekonsiliasi:</label>
                            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-soft-primary mt-4">Rekonsiliasi Stok</button>
                        </div>
                    </form>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
@endsection

@section('js')
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
