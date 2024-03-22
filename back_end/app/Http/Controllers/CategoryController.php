<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //affichage touts les categories
    public function index()
    {
        $categorys = Category::all();
        return view('layouts.main', compact( 'categorys'));
    }   

    //affichage un sule categorie
    public function show($id)   
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'La catégorie n\'existe pas.'], 404);
        }

        return response()->json($category);
    }

    //ajouter un categorie
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $category = Category::where('name', $request->name)->first();

        if ($category) {
            return response()->json('La catégorie existe déjà.');
        }

        $article = new Category();
        $article->name = $request->name;

        $article->save();

        return response()->json('catégorie ajouté avec succès');
    }

    //supprimer un categorie
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'La catégorie existe pas.']);
        }

        $category->delete();

        return response()->json('La catégorie a été supprimée avec succès.');
    }

    //modifier un categorie
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'La catégorie existe pas.'], 404);
        }

        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
        ]);

        $category->name = $request->name;
        $category->save();

        return response()->json('La catégorie a été mise à jour avec succès.');
    }
}
