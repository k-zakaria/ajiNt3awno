<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //afficage de touts les articles
    public function index(Category $category)
    {
        $articles = Article::where('category_id', $category->id)->get();

        return view('frontOffice.index', compact('articles', 'category'));
    }

    public function showArticlesByCategory(Category $category)
    {
        $articles = $category->articles()->get();

        return view('frontOffice.articles_by_category', compact('articles', 'category'));
    }

    //affichage un sule article 
    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'article existe pas.'], 404);
        }
        return response()->json($article);
    }

    //ajouter un article
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required|unique',
            'author' => 'required',
            'description' => 'required',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->author = $request->author;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->user_id = $request->user_id;
        $article->category_id = $request->category_id;


        $article->save();

        return response()->json('Article ajouté avec succès');
    }

    //supprimer un article
    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'article existe pas.']);
        }

        $article->delete();

        return response()->json('article a été supprimée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'article existe pas.'], 404);
        }

        $article->title = $request->title;
        $article->author = $request->author;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->user_id = $request->user_id;
        $article->category_id = $request->category_id;

        $article->save();

        return response()->json(['message' => 'article a été mis à jour avec succès.', 'article' => $article]);
    }

    //search article par "title"

    public function search($title)
    {
        return Article::where('title', 'like', '%' . $title . '%')->get();
    }
}
