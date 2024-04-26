@extends('layouts.main')

@section('content')

<style>
    #social-links ul {
        display: flex;
        gap: 20px;
        list-style: none;
        font-size: 1.7rem;
    }

    .fab {
        color: #333;
    }


    .fa-twitter {
        color: #1da1f2;
    }

    .fa-whatsapp {
        color: #25d366;
    }

    .fa-telegram {
        color: #0088cc;
    }

    .fa-facebook-square {
        color: #3b5998;
        /* Couleur Facebook par défaut */
    }
</style>


<section class="bg0 p-b-140 p-t-10" style="margin-top: 120px;">
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
                        <p class="f1-s-11 cl6 p-b-25 text-justify" style="line-height: 2.1;">
                            {{ $section->content }}
                        </p>
                        @endforeach

                        <!-- Share -->
                        <div class="d-flex align-items-center">
                            <span class="f1-s-12 cl5 p-t-1 m-r-15">
                                Share:
                            </span>

                            <div class="navbar-brand d-flex bg-white rounded p-2 mt-2">
                                {!! $multipleSharing !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Leave a comment -->
                <div class="mt-3 ">
                    @foreach($commentairs as $commentair)
                    <div class="flex bg-slate-50 p-6 rounded-lg " style="background-color: #ECECEC;">
                        <div class="ml-4 flex flex-col ">
                            <div class="flex flex-col sm:flex-row sm:items-center d-flex">
                                <img class="rounded-circle me-lg-2 mt-2" src="{{ $commentair->user->image ? asset('storage/' . $commentair->user->image) : 'https://c8.alamy.com/compfr/2g7ft6h/parametre-fictif-de-photo-d-avatar-par-defaut-icone-d-image-de-profil-grise-homme-en-t-shirt-2g7ft6h.jpg' }}" alt="" style="width: 40px; height: 40px;">

                                @if ($commentair->user)

                                <h5 class="card-title mt-3 ">{{ $commentair->user->name }}</h5>
                                @endif
                                <div class="ml-auto d-flex gap-5">
                                    <time class="mt-3 ">{{ $commentair->created_at }} </time>
                                    <div class="dropdown">
                                        <div class=" dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots"></i>
                                        </div>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editCommentModal">Modifier</a></li>
                                            <a class="dropdown-item " href="{{ route('commentair.delete', ['commentId' => $commentair->id]) }}" >Supprimer</a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-4" style="line-height: 2.1;" >{{ $commentair->content }}</p>
                        </div>
                    </div>

                    <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCommentModalLabel">Modifier le commentaire</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulaire de modification du commentaire -->
                                    <form action="{{ route('commentair.update', ['commentId' => $commentair->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="commentaire">Commentaire</label>
                                            <textarea class="form-control" style="line-height: 2.1;" id="commentaire" name="commentaire" rows="3">{{ $commentair->content }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Mettre à jour le commentaire</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    <div>
                        <h4 class="f1-l-4 cl3 p-b-12">
                            Leave a Comment
                        </h4>
                        @if(Auth::user())
                        <div class="mt-3">
                            <form action="{{ route('commentair.store', ['article' => $article->id]) }}" method="post">
                                @csrf
                                <textarea class="form-control" name="commentaire"  placeholder="Ajouter un commentaire..."></textarea>
                                <button type="submit" class="btn btn-primary mt-2">Commenter</button>
                            </form>
                        </div>
                        @else
                        <div class="mt-3">
                            <p>You must be logged in to comment.</p>
                            <a href="{{ route('user.login') }}" class="btn btn-primary">Se connecter</a>
                        </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection