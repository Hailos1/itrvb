<?php

use Model\Comment;
use Model\UUID;

interface CommentsRepositoryInterface {
    public function get(UUID $uuid): Comment;
    public function save(Comment $comment): void;
}

?>