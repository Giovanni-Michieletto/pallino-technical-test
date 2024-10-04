<?php

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Resources\OfferResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Resources\OfferCountryResource;

Route::group([
    'prefix' => 'v1',
    'as' => 'v1.',
    'middleware' => ['auth:sanctum'],
], function () {

    Route::get('auth/me', function (Request $request) {
        return response()->json($request->user());
    });

    Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {

        // restituisce le offerte dello shop ordinate in modo crescente per prezzo
        Route::get('{shopID}', function (string $shopID) {
            return OfferResource::collection(Offer::where('shop_id', $shopID)->orderBy('price', 'asc')->paginate());
        })->name('shop');

        // ritorna le offerte presenti nel paese selezionato e con esse anche gli shop in cui trovare il prodotto
        Route::get('{countryCode}', function (string $countryCode) {
            return OfferCountryResource::collection(Offer::whereRelation('shop', 'country', $countryCode)->with('shop')->paginate());
        })->name('country');
    });
});

// Placed outside the api group since it does not need to have middleware 'auth:sanctum'
Route::post('/auth/token', [ApiController::class, 'authToken'])->name('token');
