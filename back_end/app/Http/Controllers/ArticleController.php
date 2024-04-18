<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jorenvh\Share\Share;

class ArticleController extends Controller
{
    //afficage de touts les articles
    public function index(Category $category)
    {
        $articles = Article::with('category')->where('status', '=', 'accepted')->latest()->get();

        $leftArticles = $articles->slice(1, 3);
        $rightArticles = $articles->slice(4, 6);
        $autreArticles = $articles->slice(10, 12);
        $grandMilieuArticles = $articles->slice(22, 1);
        $milieuArticles = $articles->slice(23, 4);
        $plusAutreArticles = $articles->slice(27);

        $data = [
            'category' => $category,
            'articles' => $articles,
            'leftArticles' => $leftArticles,
            'rightArticles' => $rightArticles,
            'autreArticles' => $autreArticles,
            'grandMilieuArticles' => $grandMilieuArticles,
            'milieuArticles' => $milieuArticles,
            'plusAutreArticles' => $plusAutreArticles,
        ];

        return view('frontOffice.index', compact('data'));
    }

    public function showArticlesByCategory(Category $category)
    {
        $articles = $category->articles()->where('status', '=', 'accepted')->latest()->get();

        $rightArticles = $articles->slice(1, 5);
        $autreArticles = $articles->slice(6);

        return view('frontOffice.articles_by_category', compact('rightArticles', 'autreArticles', 'articles', 'category'));
    }

    public function searchArticles(Category $category)
    {
        $articles = Article::where('status', '=', 'accepted')->latest()->get();
        $categories = Category::all();

        return view('frontOffice.search', compact('articles', 'categories'));
    }

    public function create($id)
    {
        $articles = Article::findOrFail($id);
        $categories = Category::all();
        return view('backOffice.createArticle', compact('articles', 'categories'));
    }

    public function showDetail($id)
    {
        $article = Article::with('section.images')->findOrFail($id);
        $categories = Category::find($id);
        $multipleSharing = new Share();
        $multipleSharing->facebook();
        $multipleSharing->twitter();
        $multipleSharing->telegram();
        $multipleSharing->whatsapp();

        if (!$article) {
            abort(404, 'Article not found');
        }

        return view('frontOffice.details', compact('article', 'categories', 'multipleSharing'));
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

    public function acceptArticle($id)
    {
        return $this->updateArticleStatus($id, 'accepted');
    }

    public function archivedArticle($id)
    {
        return $this->updateArticleStatus($id, 'archived');
    }

    public function refusedArticle($id)
    {
        return $this->updateArticleStatus($id, 'refused');
    }

    public function deArchivedArticle($id)
    {
        return $this->updateArticleStatus($id, 'pending');
    }

    public function updateArticleStatus($id, $newStatus)
    {
        $validStatus = ['accepted', 'archived', 'refused', 'pending'];

        if (!in_array($newStatus, $validStatus)) {
            return redirect()->back()->with('error', 'Statut non valide.');
        }

        $article = Article::find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Article non trouvé.');
        }

        $article->status = $newStatus;
        $article->save();

        return redirect()->back();
    }
}
