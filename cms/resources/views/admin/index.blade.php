@extends('layouts.admin')

@section('header')
    Admin
@endsection

@section('content')
    Create, edit and view users, posts, categories, moderate comments and upload images.

    <h2>Chart</h2>

    <div class="chart-container" style="position: relative; height:40vh; width:60vw">
        <canvas id="adminChart"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
    var ctx = document.getElementById('adminChart').getContext('2d');
    var adminChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Users', 'Posts', 'Categories', 'Comments'],
            datasets: [{
                label: 'Total',
                data: [{{$users}}, {{$posts}}, {{$categories}}, {{$comments}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
@endsection
