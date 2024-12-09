<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        $user = DB::table('users')->where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => $user == null ? 'user not found' : 'invalid credentials'], 401);
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function register(Request $request) : JsonResponse
    {
        return response()->json("");
    }

    public function logout(Request $request) : JsonResponse
    {
        return response()->json("");
    }

    public function passwordReset(Request $request) : JsonResponse
    {
        return response()->json("");
    }

    public function confirmPasswordReset(Request $request) : JsonResponse
    {
        return response()->json("");
    }

    public function activateAccount(Request $request) : JsonResponse
    {
        return response()->json("");
    }

    public function blockAccount(Request $request) : JsonResponse
    {
        return response()->json("");
    }
}
