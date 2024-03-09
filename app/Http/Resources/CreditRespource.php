<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditRespource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=> $this->name,
            'number_card'=> $this->number_card,
            'ccv'=> $this->ccv,
            'date'=> $this->date,
            'shop_id'=> $this->shop_id,
        ];
    }
}
