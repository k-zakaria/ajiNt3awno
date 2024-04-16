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
                        <a href="#" class="f1-s-10 cl2 hov-cl10 trans-03 text-uppercase">
                            @if ($categories)
                            <p>{{ $categories->name }}</p>
                            @endif
                        </a>

                        <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                            {{ $article->title }}
                        </h3>

                        <div class="flex-wr-s-s p-b-40">
                            <span class="f1-s-3 cl8 m-r-15">
                                <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                    by {{ $article->author }}
                                </a>

                                <span class="m-rl-3">-</span>
                                <span>
                                    <time class="mt-2 sm:mt-0 sm:ml-4 text-xs text-slate-400">{{ $article->created_at }}</time>
                                </span>
                            </span>

                            <a href="#" class="f1-s-3 cl8 hov-cl10 trans-03 m-r-15">
                                0 Comment
                            </a>
                        </div>

                        <div class="wrap-pic-max-w p-b-30">
                            <img src="{{ asset('storage/images/' . $article->image) }}" alt="{{ Illuminate\Support\Str::limit($article->title, 30) }}" class="img-fluid" style="width: 100%;">
                        </div>

                        <p class="f1-s-11 cl6 p-b-25" style="font-size: large; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                            {{ $article->description }}
                        </p>

                        <p class="f1-s-11 cl6 p-b-25">
                            {{ $article->content }}
                        </p>

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

                    <form>
                        <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="msg" placeholder="Comment..."></textarea>

                        <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="name" placeholder="Name*">

                        <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="email" placeholder="Email*">

                        <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="website" placeholder="Website">

                        <button class="size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">
                            Post Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection