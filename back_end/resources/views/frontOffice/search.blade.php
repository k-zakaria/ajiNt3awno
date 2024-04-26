@extends('layouts.main')

@section('content')


<div style="margin-top: 200px;"></div>
<div class="row  d-flex justify-content-center gap-2 mb-5">
    <div class="col-md-4 ml-5">
        <input type="text" class="form-control" id="titleFilter" onkeyup="filter()" name="search" placeholder="Entrez le titre...">
    </div>
    <div class="col-md-4">
        <select class="form-select" id="categoryFilter" onchange="filter()">
            <option value="all">All Categories</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="container">
    <div class="container">
        <div class="row" id="articleContainer">
            @foreach ($articles as $article)
            <div class="col-12 col-md-6 col-lg-3 mb-4"> <!-- Adjust the column width for medium and small screens -->
                <div class="card">
                    <a href="{{ route('detail.showDetail', $article->id) }}" class="link-underline-light" style="text-decoration:none; color:#333;">
                        @if($article->image)
                        <img src="{{ asset('storage/images/' . $article->image) }}" alt="{{ Illuminate\Support\Str::limit($article->title, 60) }} Image">
                        @endif
                        <div class="card-body">
                            <p class="card-title" style="font-family: 'Fjalla One', sans-serif;font-size: 14px;">{{ Illuminate\Support\Str::limit($article->title, 50) }}</p>
                            <p class="card-text">{{ Illuminate\Support\Str::limit($article->description, 25) }}</p>
                            <div class="ml-auto">
                                <time style="font-size: 12px; color:#333;">{{ $article->created_at }}</time>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function filter() {
        var categoryValue = document.getElementById('categoryFilter').value;
        var searchValue = document.getElementById('titleFilter').value;
        var xhr = new XMLHttpRequest();

        var url = '/search?title=' + searchValue;

        if (categoryValue !== 'all') {
            url += '&category=' + categoryValue;
        }

        xhr.open('GET', url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                document.getElementById('articleContainer').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>

@endsection