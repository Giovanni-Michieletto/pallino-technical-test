<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use App\Jobs\SyncShopsJob;
use App\Jobs\SyncOffersJob;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OfferCountryResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ApiController extends Controller
{
    use ValidatesRequests;

    /**
     * Return the auth token for the given user
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function authToken(Request $request)
    {
        Log::debug('authToken');
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return     "Bearer " . $user->createToken("api")->plainTextToken;
    }

    public function offers($key)
    {
        if (is_numeric($key)) {
            return OfferResource::collection(Offer::where('ext_shop_id', $key)->orderBy('price', 'asc')->paginate());
        } else {
            return OfferCountryResource::collection(Offer::whereRelation('shop', 'country', $key)->with('shop')->paginate());
        }
    }

    public function sync($target) {
        if ($target == 'offers') {
            SyncOffersJob::dispatch();
            return response('Offers synchronization request sent');
        } elseif ($target == 'shops') {
            SyncShopsJob::dispatch();
            return response('Shops synchronization request sent');
        }
        abort(404, "Not allowed");
    }
}
