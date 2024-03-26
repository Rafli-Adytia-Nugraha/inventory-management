@extends('layouts.dashboard')
@section('title', 'Inventory Management | Velzon')
@section('sub-title', 'Stock Movements')
@section('content')
    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">Stock Movements</h4>
                    <form action="{{ route('inventory-tracking.stock-movements') }}" class="input-group w-25">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <button class="btn btn-outline-secondary" type="submit">
                            Search
                        </button>
                    </form>
                </div><!-- end cardheader -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-centered align-middle">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Transaction Date</th>
                                    <th scope="col">Quantity Adjusted</th>
                                    <th scope="col">Reason</th>
                                </tr>
                            </thead><!-- thead -->

                            <tbody>
                                @foreach ($stockMovements as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td class="fw-medium">{{ $item->inventoryItem['item_name'] }}</td>
                                        <td class="text-muted">{{ $item['transaction_date'] }}</td>
                                        <td class="text-reset">
                                            @if ($item['quantity_adjusted'] > 0)
                                                +{{ $item['quantity_adjusted'] }}
                                            @else
                                                {{ $item['quantity_adjusted'] }}
                                            @endif
                                        </td>
                                        <td class="text-muted">{{ $item['reason'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>
                    <div class="mt-3">
                        {{ $stockMovements->links() }}
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
@endsection
