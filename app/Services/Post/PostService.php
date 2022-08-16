<?php

namespace App\Services\Post;

use App\Exceptions\CustomException;
use App\Models\Like;
use App\Models\Post;
use App\Repositories\Post\LikeRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    private $postRepository;
    private $likeRepository;

    public function __construct(PostRepositoryInterface $postRepository, LikeRepositoryInterface $likeRepository)
    {
        $this->postRepository = $postRepository;
        $this->likeRepository = $likeRepository;
    }

    public function list(): Collection
    {
        try {

            $posts = $this->postRepository->getPosts();

        } catch (\Exception $exception)
        {
            throw new CustomException($exception->getMessage(), $exception->getCode());
        }

        return $posts;
    }

    public function toggleReaction($request): Post
    {
        $post = $this->postRepository->findById($request['post_id']);

        if($post['author_id'] == auth()->id())
        {

            throw new CustomException('You cannot like your post', 500);

        }

        $like = $this->likeRepository->isUserLikedPost($request['post_id'], auth()->id());

        if ($like && $request['like'])
        {

            throw new CustomException('You already liked this post', 500);

        } elseif ($like && !$request['like'])
        {

            $this->likeRepository->delete($like);

            throw new CustomException('You unlike this post successfully', 200);

        }

        $like = new Like();
        $like['post_id'] = $request['post_id'];
        $like['user_id'] = auth()->id();

        $this->likeRepository->create($like);

        return $post;
    }
}