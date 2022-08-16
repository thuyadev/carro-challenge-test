<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    public function getPosts(): Collection
    {
        return Post::with('tags', 'likes', 'user')->get();
    }

    public function findById(Int $id): Post
    {
        return Post::findorFail($id);
    }
}