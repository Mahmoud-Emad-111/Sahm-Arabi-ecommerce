<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FactoryProductResource extends JsonResource
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
            'sub_description'=> $this->sub_description,
            'description'=> $this->description,
            'image_array'=> $this->image_array,
            'category_id'=>$this->id,
            'Factory_id'=>$this->id,
        ];
    }
}
