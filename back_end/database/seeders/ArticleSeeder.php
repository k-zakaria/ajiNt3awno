<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtenez toutes les catégories
        $categories = Category::all();

        // Boucle pour créer 9 articles fictifs
        for ($i = 1; $i <= 9; $i++) {
            // Sélectionnez une catégorie aléatoire
            $category = $categories->random();

            // Créez un article avec des données fictives
            Article::create([
                'title' => "Article $i",
                'author' => 'Auteur fictif',
                'description' => "Description de l'article $i",
                'content' => "Contenu de l'article $i",
                'user_id' => 1, // Remplacez par l'ID de l'utilisateur approprié
                'category_id' => $category->id,
            ]);
        }
    }
}
