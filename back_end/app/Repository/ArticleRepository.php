<?php

namespace App\Repository;

use App\Models\Article;
use App\Repository\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function searchAcceptedArticles()
    {
        return Article::where('status', '=', 'accepted')->latest()->get();
    }

    public function findArticleById($id)
    {
        return Article::findOrFail($id);
    }

    public function findArticleWithDetails($id)
    {
        return Article::with('section.images')->findOrFail($id);
    }

    public function createArticle($data)
    {
        $imageName = null;

        if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = 'images/' . time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
        }

        $author_id = auth()->id();

        return Article::create(array_merge($data, [
            'author_id' => $author_id,
            'image' => $imageName,
        ]));
    }

    public function deleteArticle($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return false; // Article non trouvé
        }

        $article->delete();
        return true; 
    }

    public function updateArticle($article, $data)
    {
        $article->update($data);
    }
}