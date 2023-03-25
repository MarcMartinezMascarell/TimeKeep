<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Jetstream\Repositories\DeviceRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function show(Request $request, $id)
    {
        if($id) {
            $user = User::where('id_public', $id)->first();
            if(!$user) {
                return view('profile.show', [
                    'request' => $request,
                    'user' => $request->user(),
                ]);
            }
            else {
                $sessions = DB::table('sessions')->where('user_id', $user->id)->get();
                return view('profile.show', [
                    'request' => $request,
                    'user' => $user,
                    'sessions' => $sessions,
                ]);
            }
        } else {
            return view('profile.show', [
                'request' => $request,
                'user' => $request->user(),
            ]);
        }
    }
}
