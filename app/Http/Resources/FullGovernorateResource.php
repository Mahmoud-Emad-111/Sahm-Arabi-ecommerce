<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FullGovernorateResource extends JsonResource
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
      'title' => $this->title,
      'logo' =>asset(Storage::url($this->logo)),
      'governorates' => GovernorateResource::collection($this->whenLoaded('governorates')),

        ];
    }
}
