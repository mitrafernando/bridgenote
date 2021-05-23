<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->getId())->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect()->route('dashboard');
            } else {
                $password = Str::random(20);
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($password),
                    'google_id' => $user->getId()
                ]);

                Auth::login($newUser);
                return redirect()->route('dashboard');
            }

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
