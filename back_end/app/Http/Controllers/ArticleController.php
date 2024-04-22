<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Commentair;
use App\Repository\ArticleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jorenvh\Share\Share;

class ArticleController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    //afficage de touts les articles
    public function index(Category $category)
    {
        $articles = Article::with('category')->where('status', '=', 'accepted')->latest()->get();
        $messages = Article::with(['user', 'commentair'])->latest()->get();


        $leftArticles = $articles->slice(1, 3);
        $rightArticles = $articles->slice(4, 6);
        $autreArticles = $articles->slice(10, 12);
        $grandMilieuArticles = $articles->slice(22, 1);
        $milieuArticles = $articles->slice(23, 4);
        $plusAutreArticles = $articles->slice(27, 24);

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
        $articles = $this->articleRepository->searchAcceptedArticles();
        $categories = Category::all();

        return view('frontOffice.search', compact('articles', 'categories'));
    }

    public function create($id)
    {
        $article = $this->articleRepository->findArticleById($id);
        $categories = Category::all();
        return view('backOffice.createArticle', compact('article', 'categories'));
    }

    public function showDetail($id)
    {
        $article = $this->articleRepository->findArticleWithDetails($id);
        $commentairs = Commentair::with('user')->where('article_id', $id)->latest()->get();

        $categories = Category::find($id);
        $multipleSharing = new Share();
        $multipleSharing->facebook();
        $multipleSharing->twitter();
        $multipleSharing->telegram();
        $multipleSharing->whatsapp();

        if (!$article) {
            abort(404, 'Article not found');
        }

        return view('frontOffice.details', compact('article', 'categories', 'multipleSharing', 'commentairs'));
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

        $this->articleRepository->createArticle($request->all());

        return redirect()->back()->with('success', 'Article créé avec succès');
    }

    //supprimer un article
    public function destroy($id)
    {
        $success = $this->articleRepository->deleteArticle($id);

        if (!$success) {
            return redirect()->back()->with('error', 'Article non trouvé.');
        }

        return redirect()->back()->with('success', 'Article supprimé avec succès.');
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

            $this->articleRepository->updateArticle($article, $data);

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
