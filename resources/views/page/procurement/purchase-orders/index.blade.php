@extends('layouts.dashboard')
@section('title', 'Procurement | Velzon')
@section('sub-title', 'Purchase Orders')
@section('content')
    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">Purchase Orders</h4>
                    <div class="d-flex align-items-center">
                        <form action="" class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search...">
                            <button class="btn btn-outline-secondary" type="submit">
                                Search
                            </button>
                        </form>
                        <button href="" class="btn btn-soft-success btn-sm ms-2" data-bs-toggle="modal"
                            data-bs-target="#createModal">Create Order</button>
                    </div>
                </div>
            </div><!-- end cardheader -->
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-nowrap table-centered align-middle">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Delivery Date</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Action</th>
                            </tr><!-- end tr -->
                        </thead><!-- thead -->

                        <tbody>
                            @foreach ($purchaseOrders as $purchaseOrder)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }} </th>
                                    <td>{{ $purchaseOrder['order_date'] }} </td>
                                    <td>{{ $purchaseOrder['delivery_date'] }}</td>
                                    <td>{{ $purchaseOrder['total_amount'] }}</td>
                                    <td>{{ $purchaseOrder->supplier['supplier_name'] }}</td>
                                    <td>
                                        <button type="button" class="badge badge-soft-info view-btn"
                                            data-id="{{ $purchaseOrder['id'] }}"
                                            data-order-date="{{ $purchaseOrder['order_date'] }}"
                                            data-delivery-date="{{ $purchaseOrder['delivery_date'] }}"
                                            data-total-amount="{{ $purchaseOrder['total_amount'] }}"
                                            data-supplier-name="{{ $purchaseOrder->supplier['supplier_name'] }}"
                                            data-supplier-contact="{{ $purchaseOrder->supplier['contact_information'] }}"
                                            data-bs-toggle="modal" data-bs-target="#showModal">View</button>

                                        <button type="button" class="badge badge-soft-warning edit-btn"
                                            data-id="{{ $purchaseOrder['id'] }}"
                                            data-order-date="{{ $purchaseOrder['order_date'] }}"
                                            data-delivery-date="{{ $purchaseOrder['delivery_date'] }}"
                                            data-total-amount="{{ $purchaseOrder['total_amount'] }}"
                                            data-supplier-id="{{ $purchaseOrder['supplier_id'] }}" data-bs-toggle="modal"
                                            data-bs-target="#editModal">Edit</button>

                                        <button type="button" class="badge badge-soft-danger delete-btn"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-id="{{ $purchaseOrder['id'] }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div>
                <div class="mt-3">
                    {{ $purchaseOrders->links() }}
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    {{-- Modal Create Order --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('purchase-orders.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="order_date" class="form-label">Order Date:</label>
                            <input type="date" class="form-control" id="order_date" name="order_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="delivery_date" class="form-label">Delivery Date:</label>
                            <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_amount" class="form-label">Total Amount:</label>
                            <input type="number" class="form-control" id="total_amount" name="total_amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="supplier_id" class="form-label">Supplier:</label>
                            <select class="form-select" id="supplier_id" name="supplier_id" required>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier['id'] }}">{{ $supplier['supplier_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Show --}}
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <p><strong>Order Date:</strong> <span id="orderDate"></span></p>
                        <p><strong>Delivery Date:</strong> <span id="deliveryDate"></span></p>
                        <p><strong>Total Amount:</strong> <span id="totalAmount"></span></p>
                        <p><strong>Supplier:</strong> <span id="supplierName"></span></p>
                        <p><strong>Supplier Contact:</strong> <span id="supplierContact"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="edit" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editOrderId" name="order_id">
                        <div class="mb-3">
                            <label for="editOrderDate" class="form-label">Order Date:</label>
                            <input type="date" class="form-control" id="editOrderDate" name="order_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDeliveryDate" class="form-label">Delivery Date:</label>
                            <input type="date" class="form-control" id="editDeliveryDate" name="delivery_date"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editTotalAmount" class="form-label">Total Amount:</label>
                            <input type="number" class="form-control" id="editTotalAmount" name="total_amount"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editSupplierId" class="form-label">Supplier:</label>
                            <select class="form-select" id="editSupplierId" name="supplier_id" required>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier['id'] }}">{{ $supplier['supplier_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <p>Are you sure you want to delete this purchase order?</p>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const viewButtons = document.querySelectorAll('.view-btn');
            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-id');
                    const orderDate = this.getAttribute('data-order-date');
                    const deliveryDate = this.getAttribute('data-delivery-date');
                    const totalAmount = this.getAttribute('data-total-amount');
                    const supplierName = this.getAttribute('data-supplier-name');
                    const supplierContact = this.getAttribute(
                    'data-supplier-contact'); // Perbaikan nama variabel

                    document.getElementById('orderDate').textContent = orderDate;
                    document.getElementById('deliveryDate').textContent = deliveryDate;
                    document.getElementById('totalAmount').textContent = totalAmount;
                    document.getElementById('supplierName').textContent = supplierName;
                    document.getElementById('supplierContact').textContent =
                    supplierContact; // Perbaikan id element

                    const modal = new bootstrap.Modal(document.getElementById('showModal'));
                    modal.show();
                });
            });
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-id');
                    const orderDate = this.getAttribute('data-order-date');
                    const deliveryDate = this.getAttribute('data-delivery-date');
                    const totalAmount = this.getAttribute('data-total-amount');
                    const supplierId = this.getAttribute('data-supplier-id');
                    const editFormAction = `{{ route('purchase-orders.update', ':id') }}`;

                    document.getElementById('editOrderId').value = orderId;
                    document.getElementById('editOrderDate').value = orderDate;
                    document.getElementById('editDeliveryDate').value = deliveryDate;
                    document.getElementById('editTotalAmount').value = totalAmount;
                    document.getElementById('editSupplierId').value = supplierId;
                    document.getElementById('editForm').action = editFormAction.replace(':id',
                        orderId);

                    const modal = new bootstrap.Modal(document.getElementById('editModal'));
                    modal.show();
                });
            });
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-id');
                    const deleteFormAction = `{{ route('purchase-orders.destroy', ':id') }}`;
                    document.getElementById('deleteForm').action = deleteFormAction.replace(':id',
                        orderId);

                    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
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
