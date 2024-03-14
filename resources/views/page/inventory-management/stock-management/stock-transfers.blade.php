@extends('layouts.main-layout')
@section('title', 'Inventory Management')
@section('content')
    <h1 class="mb-4">Transfer Stok</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item Inventaris</th>
                    <th>Lokasi Asal</th>
                    <th>Lokasi Tujuan</th>
                    <th>Jumlah</th>
                    <th>Alasan</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockTransfers as $transfer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transfer->inventoryItem->item_name }}</td>
                        <td>{{ $transfer->fromWarehouse->name }}</td>
                        <td>{{ $transfer->toWarehouse->name }}</td>
                        <td>{{ $transfer->quantity_adjusted }}</td>
                        <td>{{ $transfer->reason }}</td>
                        <td>{{ $transfer->transaction_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $stockTransfers->links() }} <!-- Tampilkan pagination jika perlu -->
@endsection
