<?php

use Model\Post;
use Model\UUID;

interface PostsRepositoryInterface {
    public function get(UUID $uuid): Post;
    public function save(Post $post): void;
}
?>