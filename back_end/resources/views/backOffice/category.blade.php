@extends('layouts.dashboard')
@section('content')


<div class="container-fluid pt-4 px-4">
    <div class="">
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Ajouter
        </button>
        <!-- Modal pour Ajouter -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content " style="background:#191C24; color:#6C7293;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Ajouter un élément</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Contenu du formulaire pour l'ajout -->
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom de la catégorie</label>
                                <input type="text" class="form-control bg-black" id="name" name="name" placeholder="Entrez le nom de la catégorie">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
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
        <div class="col-12" style="color: #6C7293;">
            <div class=" rounded h-100 p-4" style="background: #191C24;">
                <h6 class="mb-4">Responsive Table</h6>
                <div class="table-responsive">
                    <table class="table" style="color: #6C7293;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Categories</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $categorie)
                            <tr>
                                <td scope="row">1</td>
                                <td scope="col">{{$categorie->name}}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$categorie->id}}">
                                        Delete
                                    </button>
                                    <!-- Modal pour Supprimer -->
                                    <div class="modal fade" id="deleteModal{{$categorie->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background:#191C24; color:#6C7293;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" style="color: darkslategrey;" id="deleteModalLabel">Supprimer l'élément</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="color: darkslategrey;">Êtes-vous sûr</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form id="deleteForm{{$categorie->id}}" action="{{ route('categories.destroy', $categorie) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{$categorie->id}}">
                                        Update
                                    </button>
                                    <!-- Modal pour Mettre à jour -->
                                    <div class="modal fade" id="updateModal{{$categorie->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background:#191C24; color:#6C7293;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" style="color: darkslategrey;" id="updateModalLabel">Mettre à jour l'élément</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Contenu du formulaire pour la mise à jour -->
                                                    <form action="{{ route('categories.update', $categorie) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nom de la catégorie</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $categorie->name }}" placeholder="Entrez le nom de la catégorie">
                                                            @error('name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection