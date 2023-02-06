<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\UserMeasurement;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (! auth()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'Wrong credentials...'], 401);
        }

        return response()->json([
            'message' => 'Login was successful',
            'token' =>$request->user()->createToken(auth()->user()->name . "'s Token")->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        UserMeasurement::create([
           'user_id' => $user->id,
        ]);

        return response()->json([
           'message' => 'You have been successfully registered!',
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(null, 204);
    }
}
