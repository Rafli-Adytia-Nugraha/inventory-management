@extends('layouts.dashboard')
@section('title', 'Inventory Management | Velzon')
@section('sub-title', 'Stock Transfer')
@section('content')

    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">Transfer Stok</h4>
                    <div class="d-flex align-items-center">

                        <form action="{{ route('transfers.stock.movements') }}" class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search...">
                            <button class="btn btn-outline-secondary" type="submit">
                                Search
                            </button>
                        </form>
                        <a href="" class="btn btn-soft-success btn-sm ms-2">Export
                            Report</a>
                    </div>
                </div><!-- end cardheader -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-centered align-middle">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th>No</th>
                                    <th>Item Inventaris</th>
                                    <th>Lokasi Asal</th>
                                    <th>Lokasi Tujuan</th>
                                    <th>Jumlah</th>
                                    <th>Alasan</th>
                                    <th>Tanggal Transaksi</th>
                                </tr><!-- end tr -->
                            </thead><!-- thead -->

                            <tbody>
                                @foreach ($stockTransfers as $transfer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transfer->inventoryItem->item_name }}</td>
                                        <td>{{ $transfer->fromWarehouse->name }}</td>
                                        <td>{{ $transfer->toWarehouse->name ?? '-' }}</td>
                                        <td>{{ $transfer->quantity_adjusted }}</td>
                                        <td>{{ $transfer->reason }}</td>
                                        <td>{{ $transfer->transaction_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>
                    <div class="mt-3">
                        {{ $stockTransfers->links() }}
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
@endsection
