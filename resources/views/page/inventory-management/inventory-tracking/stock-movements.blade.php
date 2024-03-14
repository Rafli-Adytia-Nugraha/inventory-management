@extends('layouts.main-layout')
@section('title', 'Inventory Management')
@section('content')
    <h1>Stock Movements</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Item Name</th>
                <th scope="col">Transaction Date</th>
                <th scope="col">Quantity Adjusted</th>
                <th scope="col">Reason</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stockMovements as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->inventoryItem['item_name'] }}</td>
                    <td>{{ $item['transaction_date'] }}</td>
                    <td>
                        @if ($item['quantity_adjusted'] > 0)
                            +{{ $item['quantity_adjusted'] }}
                        @else
                            {{ $item['quantity_adjusted'] }}
                        @endif
                    </td>
                    <td>{{ $item['reason'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
