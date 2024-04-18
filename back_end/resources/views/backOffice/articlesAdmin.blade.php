@extends('layouts.dashboard')
@section('content')

<main>
    <div class="col-12" style="color: #6C7293;">
        <div class=" rounded h-100 p-4" style="background: #191C24;">
            <h6 class="mb-4">Responsive Table</h6>
            <div class="table-responsive">
                <table class="table" style="color: #6C7293;">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col-3">Title</th>
                            <th scope="col-3">Description</th>
                            <th class="col-md-3 ">Action</th>
                        </tr>
                    </thead>
                    <tbody id="category">
                        @foreach ($articles as $article)
                        <tr>
                            <td>@if($article->image)
                                <img src="{{ asset('storage/images/' . $article->image) }}" alt="article Image" style="max-width: 150px;">
                                @endif
                            </td>

                            <td>{{$article->title}}</td>
                            <td> {{ Illuminate\Support\Str::limit($article->description, 90) }}</td>
                            <td>
                                <form action="{{ route('acceptarticle.admin', $article->id) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success"><i class="fa-regular fa-circle-check"></i></button>
                                </form>
                                <form action="{{ route('archivedarticle.admin', $article->id) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-box-archive"></i></button>
                                </form>
                                <form action="{{ route('refusedarticle.admin', $article->id) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-recycle"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="display: flex;justify-content:space-between">
                    <div style="color: rgb(74, 74, 248)">

                    </div>
                    <div style="display: flex">

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection