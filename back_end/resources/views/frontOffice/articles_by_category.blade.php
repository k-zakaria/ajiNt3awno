@extends('layouts.main')

@section('content')
<div style="margin-top: 120px;"></div>
<div class="container">
    <h2>{{ $category->name }}</h2>
    <div class="container">
        <div class="row">
            @foreach ($articles as $article)
            <div class="col-md-4 mb-4" style="max-width: 23%;">
                <div class="card">
                    <div class="card-body" >
                        <h5 class="card-title">{{Illuminate\Support\Str::limit($article->title, 30)}}</h5>
                        <p class="card-text">{{ Illuminate\Support\Str::limit($article->description, 25) }}</p>
                        <a href="{{ route('article.show', $article->id) }}" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection