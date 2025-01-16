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
            'id' => 'nullable',
            'title' => $fieldOptional ? 'nullable' : 'required',
            'release_year' => $fieldOptional ? 'nullable' : 'required',
            'movie_quality_id' => 'nullable',
            'viewer_indications' => 'nullable',
            'genres' => 'nullable',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateSerieRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'title' => $fieldOptional ? 'nullable' : 'required',
            'release_year' => $fieldOptional ? 'nullable' : 'required',
            'quality_id' => 'nullable',
            'viewer_indications' => 'nullable',
            'genres' => 'nullable',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateViewHistoryRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'profile_id' => $fieldOptional ? 'nullable' : 'required',
            'content_id' => $fieldOptional ? 'nullable' : 'required',
            'content_type' => $fieldOptional ? 'nullable' : 'required',
            'watch_date' => $fieldOptional ? 'nullable' : 'required',
            'watch_duration' => $fieldOptional ? 'nullable' : 'required',
            'completion_status' => $fieldOptional ? 'nullable' : 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateWatchlistRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'profile_id' => $fieldOptional ? 'nullable' : 'required',
            'content_id' => $fieldOptional ? 'nullable' : 'required',
            'content_type' =>  $fieldOptional ? 'nullable' : 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateProfileRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'user_id' => $fieldOptional ? 'nullable' : 'required',
            'name' => $fieldOptional ? 'nullable' : 'required',
            'profile_picture' =>  'nullable',
            'age' => $fieldOptional ? 'nullable' : 'required',
            'language' => 'nullable',
            'preference_id' => 'nullable',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateSubscriptionRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'user_id' => $fieldOptional ? 'nullable' : 'required',
            'subscription_type_id' => $fieldOptional ? 'nullable' : 'required',
            'price' =>  $fieldOptional ? 'nullable' : 'required',
            'billing_date' => $fieldOptional ? 'nullable' : 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateSubscriptionTypeRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'name' => $fieldOptional ? 'nullable' : 'required',
            'price' =>  $fieldOptional ? 'nullable' : 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateReferralRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'referrer_user_id' => $fieldOptional ? 'nullable' : 'required',
            'referred_user_id' =>  $fieldOptional ? 'nullable' : 'required',
            'discount_amount' =>  $fieldOptional ? 'nullable' : 'required',
            'status' =>  $fieldOptional ? 'nullable' : 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validatePreferenceRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'profile_id' => $fieldOptional ? 'nullable' : 'required',
            'key' =>  $fieldOptional ? 'nullable' : 'required',
            'value' =>  $fieldOptional ? 'nullable' : 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateEpisodeRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'series_id' => $fieldOptional ? 'nullable' : 'required',
            'episodes_number' =>  $fieldOptional ? 'nullable' : 'required',
            'title' =>  $fieldOptional ? 'nullable' : 'required',
            'duration' =>  $fieldOptional ? 'nullable' : 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateMovieQualityRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'movie_id' => $fieldOptional ? 'nullable' : 'required',
            'quality_type_id' =>  $fieldOptional ? 'nullable' : 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateSubtitleRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'content_id' => $fieldOptional ? 'nullable' : 'required',
            'content_type' =>  $fieldOptional ? 'nullable' : 'required',
            'language' =>  $fieldOptional ? 'nullable' : 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateQualityTypeRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'name' => $fieldOptional ? 'nullable' : 'required',
            'resolution' =>  $fieldOptional ? 'nullable' : 'required',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function validateRoleRequest(Request $request, bool $fieldOptional = true) : \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable',
            'name' => $fieldOptional ? 'nullable' : 'required',
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
