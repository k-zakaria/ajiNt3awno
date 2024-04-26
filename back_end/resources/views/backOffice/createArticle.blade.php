@extends('layouts.dashboard')
@section('content')

<div class="col-12 mt-3" style="color: #6C7293;">

    <div class=" rounded h-100 p-4" style="background: #191C24;">
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Ajouter
        </button>
        <!-- Modal pour Ajouter -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog " style="margin-left: 110px;">
                <div class="modal-content " style="width: 65rem;">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: darkslategrey;" id="addModalLabel">Ajouter un élément</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Contenu du formulaire pour l'ajout -->
                        <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="article_id" value="{{ $articles->id }}">

                            <div class="form-group">
                                <label for="titre">Title:</label>
                                <input type="text" name="titre" id="titre" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Content:</label>
                                <textarea name="content" id="content" class="form-control" required></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h6 class="mb-4">Responsive Table</h6>
        <div class="table-responsive">
            <table class="table" style="color: #6C7293;">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sections as $section)
                    <tr>
                        @if(!$section->images->isEmpty())
                            <td><img style="height:12vh; width: 20vh;" src="{{ asset('storage/images/' . $section->images[0]->image) }}" alt="Image de la section"></td>

                        @else
                            <td>null</td>
                        @endif
                    <td scope="col" style="max-width: 200px;">{{Illuminate\Support\Str::limit($section->titre, 60)}}</td>
                    <td scope="col" style="max-width: 200px;">{{ Illuminate\Support\Str::limit($section->description, 75)  }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{$section->id}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$section->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <button class="btn btn-success  btn-sm" data-bs-toggle="modal" data-bs-target="#addModal{{$section->id}}">
                            <i class="fa-solid fa-images"></i>
                        </button>
                        <!-- Modal pour Mettre à jour -->
                        <div class="modal fade" id="updateModal{{$section->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="margin-left: 240px;">
                                <div class="modal-content" style="width: 65rem;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color: darkslategrey;" id="updateModalLabel">Mettre à jour l'élément</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Contenu du formulaire pour la mise à jour -->
                                        <form action="{{ route('sections.update', $section->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="titre">Titre:</label>
                                                <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $section->titre) }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description:</label>
                                                <textarea name="description" id="description" class="form-control" required>{{ old('description', $section->description) }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="content">Contenu:</label>
                                                <textarea name="content" id="content" class="form-control" required>{{ old('content', $section->content) }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                <a href="{{ route('articles.show', $section->article_id) }}" class="btn btn-secondary">Annuler</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal pour Supprimer -->
                        <div class="modal fade" id="deleteModal{{$section->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color: darkslategrey;" id="deleteModalLabel">Supprimer l'élément</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p style="color: darkslategrey;">Êtes-vous sûr de vouloir supprimer cet événement ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <!-- Utilisez un formulaire pour envoyer une requête DELETE -->
                                        <form id="deleteForm{{$section->id}}" class="delete-section-form" action="{{ route('admin.sections.destroy', $section) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal pour Ajouter -->
                        <div class="modal fade" id="addModal{{$section->id}}" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                            <div class="modal-dialog " style="margin-left: 240px;">
                                <div class="modal-content " style="width: 65rem;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color: darkslategrey;" id="addModalLabel">Ajouter un élément</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Contenu du formulaire pour l'ajout -->
                                        <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="section_id" value="{{ $section->id }}">

                                            <div class="form-group">
                                                <label for="image">Image:</label>
                                                <input type="file" name="image" id="image" class="form-control-file" required>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary">Ajouter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>




    @endsection