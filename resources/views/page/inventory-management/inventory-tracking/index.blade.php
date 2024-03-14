@extends('layouts.main-layout')
@section('title', 'Inventory Management')

@section('content')
    <h1>Inventory Tracking</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Item Name</th>
                <th scope="col">Description</th>
                <th scope="col">Quantity on Hand</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventoryItems as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item['item_name'] }}</td>
                    <td>{{ $item['description'] }}</td>
                    <td>{{ $item['quantity_on_hand'] }}</td>
                    <td>{{ $item['unit_price'] }}</td>
                    <td><button type="button" class="btn btn-info adjust-btn" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" data-id="{{ $item->id }}">Adjust</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adjust Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="adjust-form" action="" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text">Quantity</span>
                            <input type="number" id="quantity" name="quantity" class="form-control" aria-label="Quantity"
                                aria-describedby="button-addon">
                            <button class="btn btn-outline-danger" type="button" id="kurangBtn">-</button>
                            <button class="btn btn-outline-primary" type="button" id="tambahBtn">+</button>
                        </div>
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-floating">
                            <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Enter reason for adjustment"></textarea>
                            <label for="reason">Reason</label>
                        </div>
                        @error('reason')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary form-control mt-4">Adjust Stock</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')

    <script>
        $(document).ready(function() {
            let angka = 0; // nilai awal

            // Fungsi untuk menampilkan nilai pada input box
            function updateNilai() {
                $('#quantity').val(angka);
            }

            // Event saat tombol tambah diklik
            $('#tambahBtn').click(function() {
                angka++;
                updateNilai();
            });

            // Event saat tombol kurang diklik
            $('#kurangBtn').click(function() {
                angka--;
                updateNilai();
            });

            $('.adjust-btn').click(function() {
                // Ambil ID dari atribut data-id
                let itemId = $(this).data('id');

                // Update URL formulir modal dengan ID yang sesuai
                let formAction = "{{ route('inventory-tracking.adjust-stock', ['id' => ':id']) }}";
                formAction = formAction.replace(':id', itemId);
                $('#adjust-form').attr('action', formAction);
            });
        });
    </script>
@endsection
