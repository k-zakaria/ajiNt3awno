<?php

namespace App\Repository;

interface CommentRepositoryInterface
{
    public function createComment($articleId, $userId, $content);

    public function updateComment($commentId, $userId, $content);

    public function deleteComment($commentId, $userId);
}
