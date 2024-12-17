<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserDetails(Request $request, $userEmail) : JsonResponse
    {
        $user = UserValidatorController::checkUserWithToken(["email" => $userEmail]);

        if ($user instanceof JsonResponse)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return response()->json(['error' => 'user not found'], 422);
        }

        if (!ValidateRequest::isTokenForUser($request, $user))
        {
            return response()->json(['error' => 'invalid token'], 403);
        }


        return response()->json([
            "Email" => $user->email,
            "IsActive" => $user->is_active,
            "CreatedAt" => $user->created_at,
            "UpdatedAt" => $user->updated_at,
        ]);
    }
}

