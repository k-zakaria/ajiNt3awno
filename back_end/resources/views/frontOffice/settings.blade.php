@extends('layouts.main')

@section('content')

<div class="mt-5" style="margin-bottom: 150px;"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="alert alert-warning d-flex gap-2" role="alert">
                        <img class="img-fluid rounded-circle shadow-sm" style="width: 100px; height: 100px; " src="{{ $user->image ? asset('storage/' . $user->image) : 'https://c8.alamy.com/compfr/2g7ft6h/parametre-fictif-de-photo-d-avatar-par-defaut-icone-d-image-de-profil-grise-homme-en-t-shirt-2g7ft6h.jpg' }}" alt="Image de profil">
                        <h1 class="display-3 text-uppercase  mb-2 mr-4" style="-webkit-text-stroke: 2px #333333;">{{ $user->name }}</h1>
                    </div>
                    <h2 class="card-title">Personal details</h2>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ $user->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                    </div>


                    <a href="#" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#editProfileModal">Modifier mon profil</a>

                    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProfileModalLabel">Modifier le profil</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Adresse e-mail</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image de profil</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection