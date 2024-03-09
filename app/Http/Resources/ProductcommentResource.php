<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductcommentResource extends JsonResource
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
            'name'=>$this->name,
            'price'=>$this->price,
            'sub_description'=>$this->sub_description,
            'image_array'=> asset(Storage::url($this->image_array)),
            'description'=>$this->description,
            'comments' => CommentproductResource::collection($this->whenLoaded('comments')),

        ];
    }
}
