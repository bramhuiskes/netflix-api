<?php
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class ValidateRequest
{
    public static function validateUserRequestWithoutPass($request) : \Illuminate\Validation\Validator
    {
        $rules = [
            'email' => 'required|email'
        ];

        return Validator::make($request->all(), $rules);
    }
    public static function validateUserRequest($request) : \Illuminate\Validation\Validator
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        return Validator::make($request->all(), $rules);
    }
    public static function validateUserNewPassRequest($request) : \Illuminate\Validation\Validator
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'newPassword' => 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function isTokenForUser(Request $request, User $user) : bool
    {
        $plainTextToken = $request->bearerToken();

        if (!$plainTextToken) {
            return false;
        }

        $token = \Laravel\Sanctum\PersonalAccessToken::findToken($plainTextToken);

        if (!$token || $token->tokenable_id !== $user->id) {
            return false;
        }

        return true;
    }
}
