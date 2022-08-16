<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Auth\UserLoginResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
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
            'user' => new UserLoginResource($this['user']),
            'created_at' => $this['created_at']
        ];
    }
}
