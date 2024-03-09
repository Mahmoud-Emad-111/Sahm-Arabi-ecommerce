<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class imagesproductResource extends JsonResource
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
        'description'=>$this->description,
        'category_id'=>$this->category_id,
        'imageproduct' => ProductimageResource::collection($this->whenLoaded('imageproduct')),

        ];
    }
}
