<?php

namespace App\Http\Controllers;

use App\Models\Commentair;
use App\Repository\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentairController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(Request $request, $articleId)
    {
        try {
            $request->validate([
                'commentaire' => 'required|string|max:255',
            ]);

            $userId = auth()->user()->id;
            $content = $request->input('commentaire');

            $this->commentRepository->createComment($articleId, $userId, $content);

            return redirect()->back()->with('success', 'Commentaire ajouté avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout du commentaire');
        }
    }

    public function update(Request $request, $commentId)
    {
        try {
            $request->validate([
                'commentaire' => 'required|string|max:255',
            ]);

            $userId = auth()->user()->id;
            $content = $request->input('commentaire');

            $this->commentRepository->updateComment($commentId, $userId, $content);

            return redirect()->back()->with('success', 'Commentaire mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour du commentaire');
        }
    }

    public function delete($commentId)
    {
        try {
            $userId = auth()->user()->id;

            $this->commentRepository->deleteComment($commentId, $userId);

            return redirect()->back()->with('success', 'Commentaire supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression du commentaire');
        }
    }
}
