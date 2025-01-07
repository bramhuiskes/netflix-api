<?php
namespace App\Http\Controllers;

use App\Models\User;
<<<<<<< Updated upstream
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
<<<<<<< Updated upstream
    public function getUserDetails(Request $request, $userEmail) : JsonResponse
=======
    public function getUserDetails($userEmail)
>>>>>>> Stashed changes
    {
        $user = UserValidatorController::checkUserWithToken(["email" => $userEmail]);

        if ($user instanceof Response)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return ResponseController::respond(['error' => 'user not found'], 422);
        }

<<<<<<< Updated upstream
        if (!ValidateRequest::isTokenForUser($request, $user))
        {
            return response()->json(['error' => 'invalid token'], 403);
        }


        return response()->json([
=======
        return ResponseController::respond([
>>>>>>> Stashed changes
            "Email" => $user->email,
            "IsActive" => $user->is_active,
            "CreatedAt" => $user->created_at,
            "UpdatedAt" => $user->updated_at,
        ]);
    }
}

