@extends('layouts.dashboard')
@section('content')
<!-- Content Start -->
<div class="content  w-100 " style="margin-left:0;">
    <!-- Chart Start -->
    <div class="container pt-4 ">
        <div class="card">
            <div class="card-deck mb-5 d-flex justify-content-center gap-5 text-dark">
                <div class="card shadow-sm ">
                    <div class="card-body">
                        <h5 class="card-title">User </h5>
                        <p class="card-text">{{ $countusers }}</p>
                    </div>
                </div>
                <div class="card shadow-sm ">
                    <div class="card-body">
                        <h5 class="card-title">Articles </h5>
                        <p class="card-text">{{ $countarticles }}</p>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Categories </h5>
                        <p class="card-text">{{ $countcategories }}</p>
                    </div>
                </div>
            </div>
            <div class="shadow-sm d-flex justify-content-center text-dark">
                <div class="card-body col-md-10  text-dark">
                    <h5 class="card-title text-primary">Articles par jour</h5>
                    <canvas id="articlesChart" width="200" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/nav.js') }}"></script>
@endsection