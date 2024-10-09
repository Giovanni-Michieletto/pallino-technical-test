<?php

namespace App\Services;

use App\Models\Offer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class OfferService
{
    public $label = 'OfferService';

    public function sync()
    {
        Log::debug("{$this->label} sync");
        DB::transaction(function () {
            $this->syncJsonData();
        });
        Log::debug("{$this->label} sync end");
    }

    public function syncJsonData()
    {
        Log::debug("{$this->label} syncJson");
        $json_url = config('data_source.offer.json');
        $offers = Http::get($json_url)->collect()->lazy();
        foreach ($offers as $offer) {
            $offer['ext_offer_id'] = $offer['id'];
            $offer['ext_shop_id'] = $offer['shop_id'];
            unset($offer['id']);
            unset($offer['shop_id']);
            Offer::updateOrCreate(
                ['ext_offer_id' => $offer['ext_offer_id']],
                $offer
            );
        }
    }
}
