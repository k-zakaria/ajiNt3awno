@extends('layouts.dashboard')
@section('content')

<div class="col-12 mt-3" style="color: #6C7293;">
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
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Author:</label>
                        <input type="text" name="author" id="author" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea name="content" id="content" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category:</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            @foreach($data['categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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

    <div class=" rounded h-100 p-4" style="background: #191C24;">
        <h6 class="mb-4">Responsive Table</h6>
        <div class="table-responsive">
            <table class="table" style="color: #6C7293;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">author</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['articles'] as $article)
                    <tr>
                        <td >@if($article->image)
                            <img style="height:12vh; width: 20vh;" src="{{ asset('storage/images/' . $article->image) }}" alt="{{Illuminate\Support\Str::limit($article->title, 60)}} Image">
                            @endif
                        </td>
                        <td scope="col" style="max-width: 200px;">{{Illuminate\Support\Str::limit($article->title, 60)}}</td>
                        <td scope="col">{{ $article->author }}</td>
                        <td scope="col" style="max-width: 200px;">{{ Illuminate\Support\Str::limit($article->description, 75)  }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{$article->id}}">
                                Update
                            </button>
                            <!-- Modal pour Mettre à jour -->
                            <div class="modal fade" id="updateModal{{$article->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="margin-left: 110px;">
                                    <div class="modal-content" style="width: 65rem;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="color: darkslategrey;" id="updateModalLabel">Mettre à jour l'élément</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Contenu du formulaire pour la mise à jour -->
                                            <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mt-3 mb-3">
                                                    <label for="image">Image:</label>
                                                    <input type="file" name="image" id="image" class="form-control-file">
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Title:</label>
                                                    <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="author">Author:</label>
                                                    <input type="text" name="author" id="author" class="form-control" value="{{ $article->author }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                    <textarea name="description" id="description" class="form-control" required>{{ $article->description }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="content">Content:</label>
                                                    <textarea name="content" id="content" class="form-control" required>{{ $article->content }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="category_id">Category:</label>
                                                    <select name="category_id" id="category_id" class="form-control" required>
                                                        @foreach($data['categories'] as $category)
                                                        <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$article->id}}">
                                Delete
                            </button>
                            <!-- Modal pour Supprimer -->
                            <div class="modal fade" id="deleteModal{{$article->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                            <form id="deleteForm{{$article->id}}" class="delete-article-form" action="{{ route('articles.destroy', $article) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
</div>

@endsection