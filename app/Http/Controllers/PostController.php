<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostLikeFormRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Like;
use App\Models\Post;
use App\Services\Post\PostService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ResponseTrait;

    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function list(): JsonResponse
    {
        $posts = $this->postService->list();

        return $this->responseSuccess('success', PostResource::collection($posts));
    }

    public function toggleReaction(PostLikeFormRequest $request): JsonResponse
    {
        $this->postService->toggleReaction($request);

        return $this->responseMsgOnly('You like this post successfully');
    }
}
