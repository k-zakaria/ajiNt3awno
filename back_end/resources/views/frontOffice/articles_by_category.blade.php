@extends('layouts.main')

@section('content')

<div class="container">
<div style="margin-top: 120px;"></div>
<section class="bg0 p-t-70">
    <div class="container">
        <div class="tab-content p-t-35">
            <div class="tab-pane fade show active" id="tab1-1" role="tabpanel">
                <div class="row">
                    <div class="col-sm-6 p-r-25 p-r-15-sr991">
                        <div class="m-b-30">
                            <a href="">
                                <img style="width: 40rem;" src="{{ asset('storage/images/' . $articles->last()->image) }}" alt="{{Illuminate\Support\Str::limit($articles->last()->title, 60)}} Image">
                            </a>
                            <div class="p-t-20">
                                <h5 class="p-b-5">
                                    <a href="blog-detail-01.html" class="f1-m-1 cl2 hov-cl10 trans-03 fs-3" style="text-decoration: none; color:#333;">
                                        {{ $articles->last()->title }}
                                    </a>
                                </h5>
                                <span class="cl8">
                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03" style="text-decoration: none; color:#333;">
                                        {{$articles->last()->category->name}}
                                    </a>
                                </span>
                                <div class="ml-auto"> <!-- Utiliser ml-auto pour pousser le time à droite -->
                                    @if ($articles->isNotEmpty())
                                    <p>{{$articles->last()->description}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 p-r-25 p-r-15-sr991">
                        <!-- Item post -->
                        <div class="flex-wr-sb-s ">
                            @foreach ($rightArticles as $article)
                            <time style="font-size: 12px; color:#333 ">{{ $article->created_at }}</time>
                            <a href="" class="size-w-1 wrap-pic-w hov1 trans-03">
                                @if($article->image)
                                <img style="max-width:200px;" src="{{ asset('storage/images/' . $article->image) }}" alt="{{Illuminate\Support\Str::limit($article->title, 60)}} Image">
                                @endif
                            </a>

                            <div class="size-w-2">
                                <span class="cl8">
                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03" style="text-decoration: none; color:#333;">
                                        {{ $article->category->name }}
                                    </a>
                                    <div class="ml-auto"> <!-- Utiliser ml-auto pour pousser le time à droite -->
                                    </div>
                                    <h5 class="p-b-3">
                                        <a href="" class="f1-s-5 cl3 hov-cl10 trans-03 " style="text-decoration: none; color:#333; font-size: 14px;">
                                            {{ $article->title }}
                                        </a>
                                    </h5>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2>{{ $category->name }}</h2>
            <div class="row">
                @foreach ($autreArticles as $article)

                <div class="col-md-4 mb-4" style="max-width: 25%;">
                    <div class="card">
                        <a href="{{ route('article.show', $article->id) }}" class="link-underline-light" style="text-decoration:none; color:#333;   ">
                            @if($article->image)
                            <img src="{{ asset('storage/images/' . $article->image) }}" alt="{{Illuminate\Support\Str::limit($article->title, 60)}} Image">
                            @endif
                            <div class="card-body">
                                <p class="card-title" style="font-family: 'Fjalla One', sans-serif;font-size: 14px;  ">{{Illuminate\Support\Str::limit($article->title, 60)}}</p>
                                <p class="card-text">{{ Illuminate\Support\Str::limit($article->description, 25) }}</p>
                                <div class="ml-auto"> <!-- Utiliser ml-auto pour pousser le time à droite -->
                                    <time style="font-size: 12px; color:#333 ">{{ $article->created_at }}</time>
                                </div>
                                <p>Catégorie: {{ $article->category->name }}</p>

                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endsection
    </div>
</section>

<style>

</style>