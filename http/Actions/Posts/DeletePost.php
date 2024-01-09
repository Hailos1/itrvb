<?php

namespace http\Actions\Posts;

use http\Actions\ActionInterface;
use http\ErrorResponse;
use http\Request;
use http\Response;
use http\SuccessfullResponse;
use my\Exceptions\HttpException;
use my\Model\UUID;
use my\Repositories\PostsRepositoryInterface;

class DeletePost implements ActionInterface
{
    public function __construct(
        private PostsRepositoryInterface $postRepository
    ) { }

    public function handle(Request $request): Response
    {
        try {
            $uuid = new UUID($request->query('uuid'));
            $this->postRepository->delete($uuid);
            return new SuccessfullResponse(['message' => 'Post deleted successfully']);
        } catch (HttpException $e) {
            return new ErrorResponse($e->getMessage());
        }
    }
}