<?php

namespace App\Repositories\Post;

use App\Models\Like;

interface LikeRepositoryInterface
{
    public function isUserLikedPost(int $post_id, int $user_id): ?Like;

    public function create(Like $like): Like;

    public function delete(Like $like): string;
}