<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function getPosts(): Collection;

    public function findById(Int $id): Post;
}