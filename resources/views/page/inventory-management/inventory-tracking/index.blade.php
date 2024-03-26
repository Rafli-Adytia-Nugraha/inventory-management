@extends('layouts.dashboard')
@section('title', 'Inventory Management | Velzon')
@section('sub-title', 'Inventory Tracking')

@section('content')
    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">Inventory Items</h4>
                    <form action="{{ route('inventory-tracking.index') }}" class="input-group w-25">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <button class="btn btn-outline-secondary" type="submit">
                            Search
                        </button>
                    </form>
                </div>
            </div><!-- end cardheader -->
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-nowrap table-centered align-middle">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Quantity on Hand</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Warehouse</th>
                                <th scope="col">Action</th>
                            </tr><!-- end tr -->
                        </thead><!-- thead -->

                        <tbody>
                            @foreach ($inventoryItems as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td class="fw-medium">{{ $item['item_name'] }}</td>
                                    <td class="text-reset">{{ $item['description'] }}</td>
                                    <td class="text-muted">{{ $item['quantity_on_hand'] }}</td>
                                    <td class="text-muted">{{ $item['unit_price_formatted'] }}</td>
                                    <td class="text-muted">{{ $item->warehouse['name'] }}</td>
                                    <td>
                                        <button type="button" class="badge badge-soft-info adjust-btn"
                                            data-bs-toggle="modal" data-bs-target="#adjustModal"
                                            data-id="{{ $item['id'] }}"
                                            data-quantity="{{ $item['quantity_on_hand'] }}">Adjust</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div>
                <div class="mt-3">
                    {{ $inventoryItems->links() }}
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->


    {{-- Modal Adjust --}}
    <div class="modal fade" id="adjustModal" tabindex="-1" aria-labelledby="adjustModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adjust Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=""
                        id="adjustForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group mb-3">
                            <span class="input-group-text">Quantity</span>
                            <input type="number" id="adjustQuantity" name="quantity" class="form-control">
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Enter reason for adjustment"></textarea>
                            <label for="reason">Reason</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const adjustButtons = document.querySelectorAll('.adjust-btn');
            adjustButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const quantity = this.getAttribute('data-quantity');
                    const adjustFormAction = `{{ route('inventory-tracking.adjust-stock', ':id') }}`;

                    document.getElementById('adjustQuantity').value = quantity;
                    document.getElementById('adjustForm').action = adjustFormAction.replace(':id', id);

                    const modal = new bootstrap.Modal(document.getElementById('adjustModal'));
                    modal.show();
                });
            });
        });
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