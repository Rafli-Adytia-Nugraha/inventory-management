@extends('layouts.dashboard')
@section('title', 'Inventory Management | Velzon')
@section('sub-title', 'Availability Reports')
@section('content')
    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">Availability Reports</h4>
                    <div class="d-flex align-items-center">
                        <form action="{{ route('inventory-tracking.availability-report') }}" class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search...">
                            <button class="btn btn-outline-secondary" type="submit">
                                Search
                            </button>
                        </form>
                        <a href="{{ route('inventory-tracking.export') }}" class="btn btn-soft-success btn-sm ms-2">Export
                            Report</a>
                    </div>
                </div><!-- end cardheader -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-centered align-middle">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Quantity on Hand</th>
                                    <th scope="col">Unit Price</th>
                                </tr>
                            </thead><!-- thead -->

                            <tbody>
                                @foreach ($inventoryItems as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td class="fw-medium">{{ $item['item_name'] }}</td>
                                        <td class="text-muted">{{ $item['quantity_on_hand'] }}</td>
                                        <td class="text-muted">{{ $item['unit_price'] }}</td>
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
    </div><!-- end row -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card card-height-100">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">Report</h4>
                </div>
                <div class="card-body">
                    <p>Total Quantity on Hand: {{ $totalQuantity }}</p>
                    <p>Average Unit Price: {{ $averageUnitPrice }}</p>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 py-1">Chart</h4>
                </div>
                <div class="card-body">
                    <canvas id="availabilityChart"></canvas>
                    <div class="d-flex justify-content-end">
                        <button onclick="exportChart()" class="badge badge-soft-success">Export Chart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="path/to/chartjs-plugin-export.js"></script>

    <script>
        function exportChart() {
            // Dapatkan data base64 dari chart
            var chartCanvas = document.getElementById('availabilityChart');
            var base64Image = chartCanvas.toDataURL('image/png');

            // Buat tautan download
            var downloadLink = document.createElement('a');
            downloadLink.href = base64Image;
            downloadLink.download = 'chart.png';
            downloadLink.click();
        }

        var ctx = document.getElementById('availabilityChart').getContext('2d');
        var availabilityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    label: 'Quantity on Hand',
                    data: {!! json_encode($chartData['data']) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Availability Chart'
                    },
                    datalabels: {
                        display: true,
                        color: 'black',
                        font: {
                            weight: 'bold'
                        }
                    },
                    export: {
                        enabled: true,
                        formats: ['png', 'jpeg', 'pdf'],
                        filename: 'my_chart',
                        position: 'bottom'
                    }
                },
                layout: {
                    padding: {
                        left: 50,
                        right: 50,
                        top: 20,
                        bottom: 50
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
