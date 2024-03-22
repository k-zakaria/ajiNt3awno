@extends('layouts.main')
@section('content')

<section class="container" style="margin-top: 200px;">
    <h2>{{ $category->name }}</h2>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row" id="eventsContainer">
            @foreach ($articles as $article)
            <div class="col-md-4 mb-5">
                <div class="card row__card" style="width: 18rem; height: 18rem; ">
                    <img src="" class="card-img-top" alt="Article Image">
                    <div class="card-body">
                        <h5 class="card-title">{{Illuminate\Support\Str::limit($article->title, 20)}}</h5>
                        <p class="card-text">{{ Illuminate\Support\Str::limit($article->description, 25) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection