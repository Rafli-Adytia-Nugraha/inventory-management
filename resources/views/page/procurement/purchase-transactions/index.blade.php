@extends('layouts.main-layout')
@section('title', 'Procurement')
@section('content')
    <h1>Purchase Transaction</h1>
    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createModal">Create Order</button>
    {{-- Modal Create Transaction --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('purchase-transactions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="item_id" class="form-label">Item ID:</label>
                            <select class="form-select" id="item_id" name="item_id" required>
                                <option value="">Select Item</option>
                                @foreach ($inventoryItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="order_id" class="form-label">Order ID:</label>
                            <select class="form-select" id="order_id" name="order_id" required>
                                <option value="">Select Order</option>
                                @foreach ($purchaseOrders as $order)
                                    <option value="{{ $order->id }}">{{ $order->order_date }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="transaction_date" class="form-label">Transaction Date:</label>
                            <input type="date" class="form-control" id="transaction_date" name="transaction_date"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity_purchased" class="form-label">Quantity Purchased:</label>
                            <input type="number" class="form-control" id="quantity_purchased" name="quantity_purchased"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="unit_price" class="form-label">Unit Price:</label>
                            <input type="number" class="form-control" id="unit_price" name="unit_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Total Price:</label>
                            <input type="number" class="form-control" id="total_price" name="total_price" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Item Name</th>
                <th scope="col">Order Date</th>
                <th scope="col">Transaction Date</th>
                <th scope="col">Quantity Purchased</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Total Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchaseTransactions as $purchaseTransaction)
                <tr>
                    <th scope="row">{{ $loop->iteration }} </th>
                    <td>{{ $purchaseTransaction->inventoryItem['id'] }} </td>
                    <td>{{ $purchaseTransaction->purchaseOrder['id'] }}</td>
                    <td>{{ $purchaseTransaction['transaction_date'] }}</td>
                    <td>{{ $purchaseTransaction['quantity_purchased'] }}</td>
                    <td>{{ $purchaseTransaction['unit_price'] }}</td>
                    <td>{{ $purchaseTransaction['total_price'] }}</td>
                    <td>
                        <button type="button" class="btn btn-warning view-btn" data-id="{{ $purchaseTransaction['id'] }}"
                            data-item-name="{{ $purchaseTransaction->inventoryItem['item_name'] }}"
                            data-order-date="{{ $purchaseTransaction->purchaseOrder['order_date'] }}"
                            data-transaction-date="{{ $purchaseTransaction['transaction_date'] }}"
                            data-quantity-purchased="{{ $purchaseTransaction['quantity_purchased'] }}"
                            data-unit-price="{{ $purchaseTransaction['unit_price'] }}"
                            data-total-price="{{ $purchaseTransaction['total_price'] }}">View</button>

                        <button type="button" class="btn btn-secondary edit-btn" data-id="{{ $purchaseTransaction['id'] }}"
                            data-item-id="{{ $purchaseTransaction->inventoryItem['id'] }}"
                            data-order-id="{{ $purchaseTransaction->purchaseOrder['id'] }}"
                            data-transaction-date="{{ $purchaseTransaction['transaction_date'] }}"
                            data-quantity-purchased="{{ $purchaseTransaction['quantity_purchased'] }}"
                            data-unit-price="{{ $purchaseTransaction['unit_price'] }}"
                            data-total-price="{{ $purchaseTransaction['total_price'] }}">View</button>

                        <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" data-id="{{ $purchaseTransaction['id'] }}">Delete</button> |
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal Show --}}
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <p><strong>Item Name:</strong> <span id="itemName"></span></p>
                        <p><strong>Order Date:</strong> <span id="orderDate"></span></p>
                        <p><strong>Transaction Date:</strong> <span id="transactionDate"></span></p>
                        <p><strong>Quantity Purchased:</strong> <span id="quantityPurchased"></span></p>
                        <p><strong>Unit Price:</strong> <span id="unitPrice"></span></p>
                        <p><strong>Total Price:</strong> <span id="totalPrice"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Transaction --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editTransactionId" name="transaction_id">
                        <div class="mb-3">
                            <label for="item_id" class="form-label">Item ID:</label>
                            <select class="form-select" id="editItemId" name="item_id" required>
                                <option value="">Select Item</option>
                                @foreach ($inventoryItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="order_id" class="form-label">Order ID:</label>
                            <select class="form-select" id="editOrderId" name="order_id" required>
                                <option value="">Select Order</option>
                                @foreach ($purchaseOrders as $order)
                                    <option value="{{ $order->id }}">{{ $order->order_date }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="transaction_date" class="form-label">Transaction Date:</label>
                            <input type="date" class="form-control" id="editTransactionDate" name="transaction_date"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity_purchased" class="form-label">Quantity Purchased:</label>
                            <input type="number" class="form-control" id="editQuantityPurchased" name="quantity_purchased"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="unit_price" class="form-label">Unit Price:</label>
                            <input type="number" class="form-control" id="editUnitPrice" name="unit_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Total Price:</label>
                            <input type="number" class="form-control" id="editTotalPrice" name="total_price" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
                    <h5 class="modal-title">Delete Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <p>Are you sure you want to delete this purchase transaction?</p>
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
                    const transactionId = this.getAttribute('data-id');
                    const itemName = this.getAttribute('data-item-name');
                    const orderDate = this.getAttribute('data-order-date');
                    const transactionDate = this.getAttribute('data-transaction-date');
                    const quantityPurchased = this.getAttribute('data-quantity-purchased');
                    const unitPrice = this.getAttribute('data-unit-price');
                    const totalPrice = this.getAttribute('data-total-price');

                    document.getElementById('itemName').textContent = itemName;
                    document.getElementById('orderDate').textContent = orderDate;
                    document.getElementById('transactionDate').textContent = transactionDate;
                    document.getElementById('quantityPurchased').textContent = quantityPurchased;
                    document.getElementById('unitPrice').textContent = unitPrice;
                    document.getElementById('totalPrice').textContent = totalPrice;

                    const modal = new bootstrap.Modal(document.getElementById('showModal'));
                    modal.show();
                });
            });
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const transactionId = this.getAttribute('data-id');
                    const itemId = this.getAttribute('data-item-id');
                    const orderId = this.getAttribute('data-order-id');
                    const transactionDate = this.getAttribute('data-transaction-date');
                    const quantityPurchased = this.getAttribute('data-quantity-purchased');
                    const unitPrice = this.getAttribute('data-unit-price');
                    const totalPrice = this.getAttribute('data-total-price');
                    const editFormAction = `{{ route('purchase-transactions.update', ':id') }}`;

                    document.getElementById('editTransactionId').value = transactionId;
                    document.getElementById('editItemId').value = itemId;
                    document.getElementById('editOrderId').value = orderId;
                    document.getElementById('editTransactionDate').value = transactionDate;
                    document.getElementById('editQuantityPurchased').value = quantityPurchased;
                    document.getElementById('editUnitPrice').value = unitPrice;
                    document.getElementById('editTotalPrice').value = totalPrice;
                    document.getElementById('editForm').action = editFormAction.replace(':id', transactionId);

                    const modal = new bootstrap.Modal(document.getElementById('editModal'));
                    modal.show();
                });
            });
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const transactionId = this.getAttribute('data-id');
                    const deleteFormAction = `{{ route('purchase-transactions.destroy', ':id') }}`;
                    document.getElementById('deleteForm').action = deleteFormAction.replace(':id',
                        transactionId);

                    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                    modal.show();
                });
            });
        });
    </script>
@endsection
