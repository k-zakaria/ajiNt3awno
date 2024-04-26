<?php

namespace App\Repository;

use App\Models\Commentair;
use App\Repository\CommentRepositoryInterface;


class CommentRepository implements CommentRepositoryInterface
{
    public function createComment($articleId, $userId, $content)
    {
        return Commentair::create([
            'article_id' => $articleId,
            'user_id' => $userId,
            'content' => $content,
        ]);
    }

    public function updateComment($commentId, $userId, $content)
    {
        $comment = Commentair::findOrFail($commentId);

        if ($comment->user_id !== $userId) {
            throw new \Exception("Vous n'êtes pas autorisé à mettre à jour ce commentaire");
        }

        $comment->update([
            'content' => $content,
        ]);

        return $comment;
    }

    public function deleteComment($commentId, $userId)
    {
        $comment = Commentair::findOrFail($commentId);

        if ($comment->user_id !== $userId) {
            throw new \Exception("Vous n'êtes pas autorisé à supprimer ce commentaire");
        }

        $comment->delete();

        return true;
    }
}
