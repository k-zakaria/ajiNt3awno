<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $title = $request->input('title');
        $category = $request->input('category');

        $articlesQuery = Article::query()->where('title', 'like', '%' . $title . '%');

        if ($category && $category !== 'all') {
            $articlesQuery->whereHas('Category', function ($query) use ($category) {
                $query->where('id', $category);
            });
        }

        $articles = $articlesQuery->get();

        return view('frontOffice.search-results', compact('articles'));
    }
}
