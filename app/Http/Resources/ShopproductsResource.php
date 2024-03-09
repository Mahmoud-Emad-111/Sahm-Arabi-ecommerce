<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ShopproductsResource extends JsonResource
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
            'name' => $this->name,
            'logo' => asset(Storage::url($this->logo)),
            'country' => $this->country,
            'governorate' => $this->governorate,
            'region' => $this->region,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'whatsapp_number' => $this->whatsapp_number,
            'urlStore' => $this->urlStore,
            'email' => $this->email,
            'password' =>$this->password,
            'workingScops' => $this->workingScops,
            'description' => $this->description,
            'imageCard_one' => asset(Storage::url($this->imageCard_one)),
            'imageCard_two' => asset(Storage::url($this->imageCard_two)),
            'products' => productResource::collection($this->whenLoaded('products')),

        ];
    }
}
