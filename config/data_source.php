<?php

return [
    'shop' => [
        'json' => env('SHOP_JSON_DATA_SOURCE', 'https://test.pallinolabs.it/api/v1/shops.json'),
        'csv' => env('SHOP_JSON_DATA_SOURCE', 'https://test.pallinolabs.it/shops.csv'),
    ],
    'offer' => [
        'json' => env('SHOP_JSON_DATA_SOURCE', 'https://test.pallinolabs.it/api/v1/offers.json'),
    ]
];
