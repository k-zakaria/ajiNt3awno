<div class="container">
    <div class="container">
        <div class="row">
            @foreach ($articles as $article)
            <div class="col-12 col-md-6 col-lg-3 mb-4"> <!-- Adjust the column width for medium and small screens -->
                <div class="card">
                <a href="{{ route('detail.showDetail', $article->id) }}" class="link-underline-light" style="text-decoration:none; color:#333;">
                        @if($article->image)
                        <img src="{{ asset('storage/images/' . $article->image) }}" alt="{{ Illuminate\Support\Str::limit($article->title, 60) }} Image">
                        @endif
                        <div class="card-body">
                            <p class="card-title" style="font-family: 'Fjalla One', sans-serif;font-size: 14px;">{{ Illuminate\Support\Str::limit($article->title, 60) }}</p>
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