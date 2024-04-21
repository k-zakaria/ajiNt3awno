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

    public function update(Request $request, $commentId)
    {
        $request->validate([
            'commentaire' => 'required|string|max:255',
        ]);

        $comment = Commentair::findOrFail($commentId);

        if ($comment->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to update this comment');
        }

        $comment->update([
            'content' => $request->input('commentaire'),
        ]);

        return redirect()->back()->with('success', 'Comment updated successfully');
    }

    public function delete($commentId)
{
    $comment = Commentair::findOrFail($commentId);

    if ($comment->user_id !== auth()->user()->id) {
        return redirect()->back()->with('error', 'You are not authorized to delete this comment');
    }

    $comment->delete();

    return redirect()->back()->with('success', 'Comment deleted successfully');
}

}
