<?php

namespace App\Http\Controllers\Extendeds;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as FortifyAuthenticatedSessionController;
use Laravel\Fortify\Http\Requests\LoginRequest;

class AuthenticatedSessionController extends FortifyAuthenticatedSessionController
{
    /**
     * Store the user's login session.
     *
     * @param  Request  $request
     * @param  int  $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // Call the parent store method to authenticate the user
        $response = parent::store($request);

        // Update the user's last_login_at timestamp
        $user = Auth::user();
        $user->last_login_at = now();
        $user->save();

        // Return the response
        return $response;
    }
}