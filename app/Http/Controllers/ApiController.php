<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use App\Jobs\SyncShopsJob;
use App\Jobs\SyncOffersJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * Current user
     *
     * Get information about the current logged in user
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Get Auth token
     *
     * Get authentication token after login
     *
     * @unauthenticated
     */
    public function authToken(Request $request)
    {
        Log::debug('authToken');
        $request->validate([
            /**
             * @example "api@example.com"
             */
            'email' => 'required|email',
            /**
             * @example "Tst24!"
             */
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

    /**
     * Get offers
     *
     * Get a list of offers based on shop ID or shop Country
     *
     * @param string $key shop id or shop country
     * @param string $page Page index for pagination
     */
    public function offers($key, $page = null)
    {

        if (is_numeric($key)) {
            return OfferResource::collection(Offer::where('ext_shop_id', $key)->orderBy('price', 'asc')->paginate());
        } else {
            return OfferCountryResource::collection(Offer::whereRelation('shop', 'country', $key)->with('shop')->paginate());
        }
    }

    /**
     * Sync offers or shops data
     *
     * Dispatch a job to sync offers or shops data
     *
     * @param string $target Must be 'offers' or 'shops'
     */
    public function sync($target)
    {
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
