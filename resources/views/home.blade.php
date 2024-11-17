@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Metrica</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">UI Kit</a></li>
                        <li class="breadcrumb-item active">Sparkline</li>
                    </ol>
                </div>
                <h4 class="page-title">Sparkline Charts</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body row justify-content-center">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div><!--end card-body-->
            </div><!--end crad-->
         </div><!--end col-->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body row justify-content-center">
                    <div>
                        <canvas id="myChart2"></canvas>
                    </div>
                </div><!--end card-body-->
            </div><!--end crad-->
         </div><!--end col-->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body row justify-content-center">
                    <div>
                        <canvas id="myChart3"></canvas>
                    </div>
                </div><!--end card-body-->
            </div><!--end crad-->
         </div><!--end col-->
    </div>


</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
              label: '# of Votes',
              data: [12, 19, 3, 5, 2, 3],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>
      // 2
      <script>
        const chart2 = document.getElementById('myChart2');

        const data = {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 2
        }]
        };

        new Chart(chart2, {
            type: 'doughnut',
            data: data,
        });
      </script>
      //3
      <script>
        const chart3 = document.getElementById('myChart3');

        const data3 = {
        labels: [
            'Red',
            'Green',
            'Yellow',
            'Grey',
            'Blue'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [11, 16, 7, 3, 14],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(75, 192, 192)',
            'rgb(255, 205, 86)',
            'rgb(201, 203, 207)',
            'rgb(54, 162, 235)'
            ]
        }]
        };

        new Chart(chart3, {
            type: 'polarArea',
            data: data3,
            options: {}
        });
      </script>
@stop
