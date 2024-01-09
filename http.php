<?php

use http\Actions\Comments\CreateComment;
use http\Actions\Likes\CreateCommentLike;
use http\Actions\Likes\CreatePostLike;
use http\Actions\Likes\GetByUuidCommentLikes;
use http\Actions\Likes\GetByUuidPostLikes;
use http\Actions\Posts\CreatePost;
use http\Actions\Posts\DeletePost;
use http\Actions\Users\CreateUser;
use http\Actions\Users\FindByUsername;
use http\ErrorResponse;
use http\Request;
use Psr\Log\LoggerInterface;


ini_set('display_errors', 1);
error_reporting(E_ALL);

$container = require __DIR__ . '/bootstrap.php';

$logger = $container->get(LoggerInterface::class);

try {
    $request = new Request($_GET, $_POST, $_SERVER);
} catch (Exception $ex) {
    $logger->warning($ex->getMessage());
    (new ErrorResponse($ex->getMessage()))->send();
    return;
}

try {
    $path = $request->path();
} catch (Exception $ex) {
    $logger->warning($ex->getMessage());
    (new ErrorResponse($ex->getMessage()))->send();
    return;
}

try {
    $method = $request->method();
} catch (Exception $ex) {
    $logger->warning($ex->getMessage());
    (new ErrorResponse($ex->getMessage()))->send();
    return;
}

$routs = [
    'GET' => [
        '/users/show' => FindByUsername::class,
        '/likes/comment' => GetByUuidCommentLikes::class,
        '/likes/post' => GetByUuidPostLikes::class,
    ],
    'POST' => [
        '/posts/comment' => CreateComment::class,
        '/posts/' => CreatePost::class,
        '/likes/post/' => CreatePostLike::class,
        '/likes/comment/' => CreateCommentLike::class,
        '/user/' => CreateUser::class
    ],
    'DELETE' => [
        '/posts' => DeletePost::class
    ]
];

$response = new ErrorResponse('An unknown error occurred.');

try {
    $path = $request->path();
    $method = $request->method();

    if (!array_key_exists($method, $routs) || !array_key_exists($path, $routs[$method])) {
        $message = "Route not found: $method $path";
        $logger->notice($message);
        $response = new ErrorResponse($message);
    } else {
        $actionClassName = $routs[$method][$path];
        $action = $container->get($actionClassName);
        $response = $action->handle($request);
    }
} catch (Exception $ex) {
    $logger->error($ex->getMessage(), ['exception' => $ex]);
    $response = new ErrorResponse($ex->getMessage());
}

$response->send();