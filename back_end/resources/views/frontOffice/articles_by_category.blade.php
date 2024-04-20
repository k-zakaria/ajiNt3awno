@extends('layouts.main')

@section('content')

<div style="margin-top: 120px;"></div>
<style>
    img {
        width: 100%;
    }

    a {
        text-decoration: none;
        color: #333;
    }
</style>

<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        @if ($articles->isNotEmpty())
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                @if ($articles[0]->image)
                                <img src="{{ asset('storage/images/' . $articles[0]->image) }}" alt="{{ Illuminate\Support\Str::limit($articles[0]->title, 60) }} Image">
                                @endif
                                <div class="trend-top-cap">
                                    <span>
                                        {{ $articles[0]->category->name }}
                                    </span>
                                    <h2><a href="details.html">{{ $articles[0]->title }}</a></h2>
                                    <p>{{ Illuminate\Support\Str::limit($articles[0]->content,400 )}}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Riht content -->
                    <div class="col-lg-4">
                        @foreach ($rightArticles as $article)
                        <div class="trand-right-single d-flex mb-4 gap-3">
                            <div class="trand-right-img">
                                @if($article->image)
                                <img style="max-width: 300px;" src="{{ asset('storage/images/' . $article->image) }}" alt="{{Illuminate\Support\Str::limit($article->title, 60)}} Image">
                                @endif
                            </div>
                            <div class="trand-right-cap">
                                <p><a href="details.html" style="font-size: 13px;">{{ Illuminate\Support\Str::limit($article->title,50 )}}</a></p>
                                <span class="color1">{{ $article->category->name }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="container">
    <h2>{{ $category->name }} <hr class="w-100"></h2>
    <div class="container">
        <div class="row">
            @foreach ($autreArticles as $article)
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <a href="{{ route('detail.showDetail', $article->id) }}" class="link-underline-light" style="text-decoration:none; color:#333;   ">
                        @if($article->image)
                        <img src="{{ asset('storage/images/' . $article->image) }}" alt="{{Illuminate\Support\Str::limit($article->title, 60)}} Image">
                        @endif
                        <div class="card-body">
                            <p class="card-title" style="font-family: 'Fjalla One', sans-serif;font-size: 14px;  ">{{Illuminate\Support\Str::limit($article->title, 55)}}</p>
                            <p class="card-text">{{ Illuminate\Support\Str::limit($article->description, 25) }}</p>
                            <div class="ml-auto">
                                <time style="font-size: 12px; color:#333 ">{{ $article->created_at }}</time>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
</div>
</section>

<style>

</style>