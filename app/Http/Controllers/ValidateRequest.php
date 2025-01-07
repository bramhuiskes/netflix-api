<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public static function validateMovieRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'movie_id' => 'nullable',
            'title' => $fieldOptional ? 'nullable' : 'required',
            'release_year' => $fieldOptional ? 'nullable' : 'required',
            'movie_quality_id' => 'nullable',
            'viewer_indications' => 'nullable',
            'genres' => 'nullable',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateDeleteRequest(Request $request) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

}
