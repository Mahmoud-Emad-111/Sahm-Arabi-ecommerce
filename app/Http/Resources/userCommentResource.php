<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class userCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->random_id,
            'Fullname'=>$this->Fullname,
            'phone_number'=>$this->phone_number,
            'email'=>$this->email,
            'password'=>$this->password,
            'comments_users' => CommentResource::collection($this->whenLoaded('CommentsUsers')),
        ];
    }
}
