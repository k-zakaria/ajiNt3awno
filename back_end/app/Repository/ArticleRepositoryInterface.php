<?php

namespace App\Repository;

use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function searchAcceptedArticles();
    public function findArticleById($id);
    public function findArticleWithDetails($id);
    public function createArticle($data);
    public function deleteArticle($id);
    public function updateArticle($article, $data);
}