<?php

namespace http\Actions\Comments;

use my\Repositories\CommentsRepositoryInterface;
use http\Actions\ActionInterface;
use http\ErrorResponse;
use http\Request;
use http\Response;
use http\SuccessfullResponse;
use my\Model\Comment;
use my\Model\UUID;

class CreateComment implements ActionInterface
{
    public function __construct(
        private CommentsRepositoryInterface $commentRepository
    ) { }
    public function handle(Request $request): Response
    {
        try {
            $data = $request->body(['author_uuid', 'post_uuid', 'text']);
            $authorUuid = new UUID($data['author_uuid']);
            $postUuid = new UUID($data['post_uuid']);
            $text = $data['text'];

            if (empty($text)) {
                throw new \InvalidArgumentException('Text cannot be empty');
            }

            $comment = new Comment(UUID::random(), $authorUuid, $postUuid, $text);

            $this->commentRepository->save($comment);

            return new SuccessfullResponse(['message' => 'Comment created successfully']);
        } catch (\Exception $ex) {
            return new ErrorResponse($ex->getMessage());
        }
    }
}