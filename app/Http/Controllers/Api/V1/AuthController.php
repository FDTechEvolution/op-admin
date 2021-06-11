<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response(['message' => 'The provided credentials are incorrect.'], 401);
        }

        $token = $user->createToken('Online_POS_App_Token')->plainTextToken;

        return response(['token' => $token, 'user' => $user->username], 200);
    }


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'Loged out'], 200);
    }
}
