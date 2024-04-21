@extends('layouts.dashboard')
@section('content')
<!-- Content Start -->
<div class="content  w-100 " style="margin-left:0;">
    <!-- Chart Start -->
    <div class="container pt-4 ">
        <div class="card">
            <div class="card-deck mb-5 d-flex justify-content-center gap-4 text-dark">
                <div class="card shadow-sm bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">User </h5>
                        <p class="card-text">{{ $countusers }}</p>
                    </div>
                </div>
                <div class="card shadow-sm bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Articles </h5>
                        <p class="card-text">{{ $countarticles }}</p>
                    </div>
                </div>
                <div class="card shadow-sm bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Categories </h5>
                        <p class="card-text">{{ $countcategories }}</p>
                    </div>
                </div>
            </div>
            <div class="shadow-sm d-flex text-dark">
                <div class="card-body col-md-10 bg-info text-dark">
                    <h5 class="card-title">Articles par jour</h5>
                    <canvas id="articlesChart" width="200" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
     document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('articlesChart').getContext('2d');

        var articlesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Articles par jour',
                    data: {!! json_encode($data) !!},
                    fill: false,
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.1
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
    });
</script>

@endsection