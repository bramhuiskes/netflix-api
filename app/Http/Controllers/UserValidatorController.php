<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserValidatorController
{
    public static function checkUserWithoutToken(array $validatedRequest) : object
    {
        if ($validatedRequest['email'] == null) {
            return response()->json(['error' => 'email not in header'], 422);
        }

        $user = User::where('email', $validatedRequest['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'user not found'], 403);
        }

        if ($validatedRequest['password'] == null) {
            return response()->json(['error' => 'password not in header'], 422);
        }

        if (!Hash::check($validatedRequest['password'], $user->password)) {
            return response()->json(['error' => 'invalid credentials'], 401);
        }

        return $user;
    }

    public static function checkUserWithToken(array $validatedRequest) : object
    {
        if ($validatedRequest['email'] == null) {
            return response()->json(['error' => 'email not in header'], 422);
        }

        $user = User::where('email', $validatedRequest['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'user not found'], 403);
        }

        return $user;
    }
}
