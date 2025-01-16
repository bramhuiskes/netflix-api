<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserValidatorController
{
    public static function checkUserWithoutToken(array $validatedRequest) : object
    {
        if ($validatedRequest['email'] == null) {
            return ResponseController::respond(['error' => 'email not in header'], 422);
        }

        $user = User::where('email', $validatedRequest['email'])->first();

        if (!$user) {
            return ResponseController::respond(['error' => 'user not found'], 404);
        }

        if ($validatedRequest['password'] == null) {
            return ResponseController::respond(['error' => 'password not in header'], 422);
        }

        if (!Hash::check($validatedRequest['password'], $user->password)) {
            return ResponseController::respond(['error' => 'invalid credentials'], 401);
        }

        return $user;
    }

    public static function checkUserWithToken(array $validatedRequest) : object
    {
        if ($validatedRequest['email'] == null) {
            return ResponseController::respond(['error' => 'email not in header'], 422);
        }

        $user = User::where('email', $validatedRequest['email'])->first();

        if (!$user) {
            return ResponseController::respond(['error' => 'user not found'], 404);
        }

        return $user;
    }
}
