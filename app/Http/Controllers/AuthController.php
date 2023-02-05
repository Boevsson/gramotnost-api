<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email'              => ['required', 'email'],
            'password'    => ['required'],
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token =  $user->createToken('MyApp')->plainTextToken;

            return response()->json([
                'user' => $user,
                'auth_token' => $token
            ]);
        }

        return response()->json('Unauthorized', 401);
    }
}
