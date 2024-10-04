<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ShopResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferCountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => $this->product,
            'price' => $this->price,
            'currency' => $this->currency,
            'description' => $this->description,
            'shops' => ShopResource::collection($this->shops)
        ];
    }
}
