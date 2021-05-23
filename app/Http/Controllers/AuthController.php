<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request) {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'error' => 'Invalid Email or Password'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        return response([
            'token' => $token
        ]);
    }

    public function registerWithGoogle(Request $request) {
        $password = Str::random(20);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($password)
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
