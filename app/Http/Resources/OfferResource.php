<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'shop_id' => $this->ext_shop_id,
            'product' => $this->product,
            'price' => $this->price,
            'currency' => $this->currency,
            'description' => $this->description
        ];
    }
}
