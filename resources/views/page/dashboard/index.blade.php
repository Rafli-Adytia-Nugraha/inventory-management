@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('css')
<style>
  .card-body.p-2 {
    padding-top: 20px !important;
  } 

  .col-sm-2 {
    margin-bottom: 20px;
  }
  
  .table-responsive {
    margin-bottom: 0px !important;
  }
</style>
@endsection

@section('content')
<div class="row row-card">
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body p-2 text-center">
        <div class="m-0"><h1>{{ 0 }}</h1></div>
        <div class="text-muted mb-3">
          <a href="#">
            CR Upload
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body p-2 text-center">
        <div class="m-0"><h1>{{ 0 }}</h1></div>
        <div class="text-muted mb-3">
          <a href="#">
            Total Aset
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body p-2 text-center">
        <div class="m-0"><h1>{{  0  }}</h1></div>
        <div class="text-muted mb-3">
          <a href="#">
            GR Source Project
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body p-2 text-center">
        <div class="m-0"><h1>{{ 0 }}</h1></div>
        <div class="text-muted mb-3">
          <a href="#">
            GR Transmital Form
          </a>
        </div>
      </div>
    </div>
    <br/>
  </div>

  <div class="col-lg-9">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Change Request Upload</h3>
            <div id="chart-picking" class="chart-lg"></div>
          </div>
        </div>
        <br/>
      </div>
    </div>
  </div>

  <div class="col-lg-3">
    <div class="row row-cards">
      <div class="col-12">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <desc>Download more icon variants from https://tabler-icons.io/i/database</desc>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                    <path d="M4 6v6a8 3 0 0 0 16 0v-6"></path>
                    <path d="M4 12v6a8 3 0 0 0 16 0v-6"></path>
                 </svg>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">
                  Free Juggling
                </div>
                <div class="text-muted">
                  {{ 0 }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="./dist/libs/apexcharts/dist/apexcharts.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    window.ApexCharts && (new ApexCharts(document.getElementById('chart-picking'), {
      chart: {
        type: "bar",
        fontFamily: 'inherit',
        height: 240,
        parentHeightOffset: 0,
        toolbar: {
          show: false,
        },
        animations: {
          enabled: false
        },
        stacked: true,
      },
      plotOptions: {
        bar: {
          columnWidth: '50%',
        }
      },
      dataLabels: {
        enabled: false,
      },
      fill: {
        opacity: 1,
      },
      series: [{
        name: "PO",
        data: [26, 41, 22, 46, 47, 81, 46, 6]
      }],
      grid: {
        padding: {
          top: -20,
          right: 0,
          left: -4,
          bottom: -4
        },
        strokeDashArray: 4,
        xaxis: {
          lines: {
            show: true
          }
        },
      },
      xaxis: {
        labels: {
          padding: 0,
        },
        tooltip: {
          enabled: false
        },
        axisBorder: {
          show: false,
        },
        type: 'datetime',
      },
      yaxis: {
        labels: {
          padding: 4
        },
      },
      labels: [
        '2022-01', '2022-02', '2022-03', '2022-04', '2022-05', '2022-06', '2022-07', '2022-08',
      ],
      colors: ["#206bc4"],
      legend: {
        show: false,
      },
    })).render();
  });
</script>
@endsection