<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Auth\UserLoginResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'title' => $this['title'],
            'description' => $this['description'],
            'like_counts' => $this['like_counts'],
            'tags' => TagResource::collection($this['tags']),
            'user' => new UserLoginResource($this['user']),
            'likes' => LikeResource::collection($this['likes'])
        ];
    }
}
