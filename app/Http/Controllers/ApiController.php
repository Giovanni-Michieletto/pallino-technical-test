<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Shop;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
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
}
