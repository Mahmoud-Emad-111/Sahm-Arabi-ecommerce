<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class productResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        // $productImageArray = $this->image_array;
        // $selectedImage = isset($productImageArray[0]) ? $productImageArray[0] : null;

        return [
            'id'=>$this->random_id,
            'name'=>$this->name,
            'price'=>$this->price,
            'sub_description'=> $this->sub_description,
            'description'=> $this->description,
            'image_array'=> $this->image_array,
            'category_id'=>$this->id,
            'Shop_id'=>$this->id,
        ];
    }
}
