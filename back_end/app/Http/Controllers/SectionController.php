<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function show($id)
    {
        
        $sections = Section::with('images')->where('article_id', $id)->get();
        $articles = Article::findOrFail($id);
        $images = Image::all();

        return view('backOffice.createArticle', compact('sections', 'articles', 'images'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'article_id' => 'required|exists:articles,id',
        ]);

        Section::create([
            'titre' => $validatedData['titre'],
            'description' => $validatedData['description'],
            'content' => $validatedData['content'],
            'article_id' => $validatedData['article_id'],
        ]);


        return redirect()->back()->with('success', 'Section ajoutée avec succès!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
        ]);

        $section = Section::findOrFail($id);
        $section->update($validatedData);

        return redirect()->back()->with('success', 'Section mise à jour avec succès!');
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $articleId = $section->article_id;
        $section->delete();

        return redirect()->back()->with('success', 'Section supprimée avec succès!');
    }
}
