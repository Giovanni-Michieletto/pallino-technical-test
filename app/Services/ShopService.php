<?php

namespace App\Services;

use App\Models\Shop;
use App\Imports\ShopImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ShopService
{
    public $label = 'ShopService';

    public function sync()
    {
        Log::debug("{$this->label} sync");
        DB::transaction(function () {
            $this->syncJsonData();
            $this->syncCsvData();
        });
        Log::debug("{$this->label} sync end");
    }

    public function syncJsonData()
    {
        Log::debug("{$this->label} syncJson");
        $json_url = config('data_source.shop.json');
        $shops = Http::get($json_url)->collect()->lazy();
        foreach ($shops as $shop) {
            $shop['ext_shop_id'] = $shop['id'];
            unset($shop['id']);
            Shop::updateOrCreate(
                ['ext_shop_id' => $shop['ext_shop_id']],
                $shop
            );
        }
    }


    public function syncCsvData()
    {
        Log::debug("{$this->label} syncCsv");
        $csv_url = config('data_source.shop.csv');
        $disk_name = 'spool';
        $disk =  Storage::disk($disk_name);
        $file_name = 'shops_' . getmypid() . '.csv';
        $disk->put($file_name, Http::get($csv_url)->body());
        Excel::import(new ShopImport, $file_name, $disk_name);
        $disk->delete($file_name);
    }
}
