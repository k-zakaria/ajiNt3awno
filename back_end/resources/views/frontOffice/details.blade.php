@extends('layouts.main')

@section('content')

<style>
    #social-links ul {
        display: flex;
        gap: 20px;
        list-style: none;
    }
</style>


<section class="bg0 p-b-140 p-t-10" style="margin-top: 200px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 p-b-30">
                <div class="p-r-10 p-r-0-sr991">
                    <!-- Blog Detail -->
                    <div class="p-b-70">
                            @if ($categories)
                            <p>{{ $categories->name }}</p>
                            @endif
                        <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                            {{ $article->title }}
                        </h3>

                        <div class="flex-wr-s-s p-b-40">
                            <span class="f1-s-3 cl8 m-r-15">
                                    by {{ $article->author }}
                                <span class="m-rl-3">-</span>
                                <span>
                                    <time class="mt-2 sm:mt-0 sm:ml-4 text-xs text-slate-400">{{ $article->created_at }}</time>
                                </span>
                            </span>
                        </div>

                        <div class="wrap-pic-max-w p-b-30">
                            <img src="{{ asset('storage/images/' . $article->image) }}" alt="{{ Illuminate\Support\Str::limit($article->title, 30) }}" class="img-fluid" style="width: 100%;">
                        </div>

                        <p class="f1-s-11 cl6 p-b-25" style="font-size: large; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                            {{ $article->description }}
                        </p>

                        <p class="text-justify" style="line-height: 2.1;">
                            {{ $article->content }}
                        </p>

                        @foreach ($article->section as $section)
                        @foreach ($section->images as $image)
                        <div>
                            <img src="{{ asset('storage/images/' . $image->image) }}" alt="{{ Illuminate\Support\Str::limit($article->title, 30) }}" class="img-fluid" style="width: 100%;">
                        </div>
                        @endforeach

                        <h3 class="">
                            {{ $section->titre }}
                        </h3>

                        <p class="text-muted" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                            {{ $section->description }}
                        </p>
                        <hr class="w-100">
                        <p class="f1-s-11 cl6 p-b-25" style="line-height: 2.1;">
                            {{ $section->content }}
                        </p>
                        @endforeach

                        <!-- Share -->
                        <div class="d-flex align-items-center">
                            <span class="f1-s-12 cl5 p-t-1 m-r-15">
                                Share:
                            </span>

                            <div class="navbar-brand d-flex bg-white rounded p-2">
                                {!! $multipleSharing !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Leave a comment -->
                <div>
                    <h4 class="f1-l-4 cl3 p-b-12">
                        Leave a Comment
                    </h4>

                    <p class="f1-s-13 cl8 p-b-40">
                        Your email address will not be published. Required fields are marked *
                    </p>

                    <div class="mt-3">
                        <form action="g" method="post">
                            @csrf
                            <textarea class="form-control" name="commentaire" placeholder="Ajouter un commentaire..."></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Commenter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection