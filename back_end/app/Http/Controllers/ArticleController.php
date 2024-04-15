<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    //afficage de touts les articles
    public function index(Category $category)
    {
        $articles = Article::where('status', '=', 'accepted')->latest()->get();

        $leftArticles = $articles->slice(1, 3);
        $rightArticles = $articles->slice(4, 7);
        $autreArticles = $articles->slice(9);

        return view('frontOffice.index', compact('leftArticles', 'rightArticles', 'category', 'autreArticles', 'articles'));
    }

    public function showArticlesByCategory(Category $category)
    {
        $articles = $category->articles()->latest()->get();

        $rightArticles = $articles->slice(1, 4);
        $autreArticles = $articles->slice(5);

        return view('frontOffice.articles_by_category', compact('rightArticles', 'autreArticles', 'articles', 'category'));
    }

    public function searchArticles(Category $category)
    {
        $articles = Article::where('status', '=', 'accepted')->latest()->get();
        $categories = Category::all();

        return view('frontOffice.search', compact('articles', 'categories'));
    }


    public function showDetail($id)
    {
        $article = Article::find($id);

        if (!$article) {
            abort(404, 'Article not found');
        }

        return view('frontOffice.details', compact('article'));
    }

    //affichage un sule article 
    public function show()
    {
        $author_id = Auth::id();
        $articles = Article::where('author_id', $author_id)->paginate(4);
        $categories = Category::all();


        $data = [
            'articles' => $articles,
            'categories' => $categories,
        ];
        return view('backOffice.articles', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $author_id = auth()->id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'images/' . time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
        }

        Article::create(array_merge($request->all(), [
            'author_id' => $author_id,
            'image' => $imageName ?? null
        ]));

        return redirect()->back()->with('success', 'Article créé avec succès');
    }

    //supprimer un article
    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'article existe pas.']);
        }

        $article->delete();

        return redirect()->back()->with('success', 'article a été supprimée avec succès.');
    }



    public function update(Request $request, Article $article)
    {
        try {
            $validatedData = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required',
                'author' => 'required',
                'description' => 'required',
                'content' => 'required',
                'category_id' => 'required|exists:categories,id',
            ]);

            $author_id = auth()->id();

            $data = [
                'title' => $validatedData['title'],
                'author' => $validatedData['author'],
                'description' => $validatedData['description'],
                'content' => $validatedData['content'],
                'category_id' => $validatedData['category_id'],
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'images/' . time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
                $data['image'] = $imageName;
            }

            $article->update($data);

            return redirect()->back()->with('success', 'Article mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de l\'article.');
        }
    }


    //search article par "title"


    public function showArticleAdmin()
    {
        $articles = Article::where('status', '=', 'pending')->get();

        return view('backOffice.articlesAdmin', compact('articles'));
    }

    public function showArchivedArticles()
    {
        $articles = Article::where('status', '=', 'archived')->get();

        return view('backOffice.articlesArchivedAdmin', compact('articles'));
    }

    public function showRefusedArticles()
    {
        $articles = Article::where('status', '=', 'refused')->get();

        return view('backOffice.articlesRefusedAdmin', compact('articles'));
    }

    public function acceptarticle($id)
    {
        $event = Article::find($id);
        $event->status = 'accepted';
        $event->save();
        return redirect()->back();
    }

    public function archivedarticle($id)
    {
        $event = Article::find($id);
        $event->status = 'archived';
        $event->save();
        return redirect()->back();
    }

    public function refusedarticle($id)
    {
        $event = Article::find($id);
        $event->status = 'refused';
        $event->save();
        return redirect()->back();
    }

    public function deArchivedarticle($id)
    {
        $event = Article::find($id);
        $event->status = 'pending';
        $event->save();
        return redirect()->back();
    }
}
