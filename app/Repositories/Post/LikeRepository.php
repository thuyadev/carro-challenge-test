<?php

namespace App\Repositories\Post;

use App\Models\Like;

class LikeRepository implements LikeRepositoryInterface
{
    public function isUserLikedPost(int $post_id, int $user_id): ?Like
    {
        $like = Like::userLikedPost($post_id, $user_id)->first();

        return $like;
    }

    public function create(Like $like): Like
    {
        $like->save();

        return $like;
    }

    public function delete(Like $like): string
    {
        $like->delete();

        return 'success';
    }
}