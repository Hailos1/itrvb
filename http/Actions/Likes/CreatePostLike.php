<?php

namespace http\Actions\Likes;

use http\Actions\ActionInterface;
use http\ErrorResponse;
use http\Request;
use http\Response;
use http\SuccessfullResponse;
use my\Model\PostLike;
use my\Model\UUID;
use my\Repositories\PostLikeRepositoryInterface;

class CreatePostLike implements ActionInterface
{
    public function __construct(
        private PostLikeRepositoryInterface $postLikeRepository
    )
    {

    }

    public function handle(Request $request): Response
    {
        try {
            $data = $request->body(['post_uuid', 'user_uuid']);
            $uuid = UUID::random();
            $postUuid = new UUID($data['post_uuid']);
            $userUuid = new UUID($data['user_uuid']);

            $post = new PostLike($uuid, $postUuid, $userUuid);
            $this->postLikeRepository->save($post);

            return new SuccessfullResponse(['message' => 'Post like created successfully']);
        } catch (\Exception $ex) {
            return new ErrorResponse($ex->getMessage());
        }
    }
}