<?php

namespace App\Http\Resources;

use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Author $author */
        $author = $this;
        $response = [
            'id' => $author->id,
            'karma' => $author->karma ?? 0,
            'votes' => $author->votes ?? 0,
            'is_community' => $author->is_community ?? 0,
            'first_login' => $this->first_login ?? false,
            'vk_user_id' => $author->vk_user_id,
            'created_at' => $author->created_at,
            'updated_at' => $author->updated_at,
        ];

        if ($this->token) {
            $response['token'] = $this->token;
        }

        return $response;
    }
}
