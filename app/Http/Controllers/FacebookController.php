<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $findUser = User::where('facebook_id', $user->getId())->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect()->route('dashboard');
            } else {
                $password = Str::random(20);
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($password),
                    'facebook_id' => $user->getId()
                ]);

                Auth::login($newUser);
                return redirect()->route('dashboard');
            }

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
