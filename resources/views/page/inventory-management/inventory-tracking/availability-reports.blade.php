@extends('layouts.main-layout')
@section('title', 'Inventory Management')
@section('content')
    <h1>Availability Reports</h1>
    <a type="button" class="btn btn-success" href="/inventory-tracking/export">Export</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Item Name</th>
                <th scope="col">Quantity on Hand</th>
                <th scope="col">Unit Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventoryItems as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item['item_name'] }}</td>
                    <td>{{ $item['quantity_on_hand'] }}</td>
                    <td>{{ $item['unit_price'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div>
        <p>Total Quantity on Hand: {{ $totalQuantity }}</p>
        <p>Average Unit Price: {{ $averageUnitPrice }}</p>
    </div>
    <div>
        <canvas id="availabilityChart"></canvas>
    </div>
    <button onclick="exportChart()">Export Chart</button>

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
