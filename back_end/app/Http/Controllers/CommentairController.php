<?php

namespace App\Http\Controllers;

use App\Models\Commentair;
use Illuminate\Http\Request;

class CommentairController extends Controller
{
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'commentaire' => 'required|string|max:255',
        ]);

        Commentair::create([
            'article_id' => $articleId,
            'user_id' => auth()->user()->id,
            'content' => $request->input('commentaire'),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully');
    }
}
