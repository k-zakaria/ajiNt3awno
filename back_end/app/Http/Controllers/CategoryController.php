<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    //affichage un sule categorie
    public function get()
    {
        $categories = Category::paginate(6);
        return view('backOffice.category', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->back()->with('success', 'Category created successfully');
    }


    public function update(Request $request, Category $categorie)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $categorie->update($request->all());

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function destroy(Category $categorie)
    {
        $categorie->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
