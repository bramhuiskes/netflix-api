<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController
{
    public function getUserDetails(Request $request, $userEmail)
    {
        $user = UserValidatorController::checkUserWithToken(["email" => $userEmail]);

        if ($user instanceof Response)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return ResponseController::respond(['error' => 'user not found'], 404);
        }

        if (!ValidateRequest::isTokenForUser($request, $user))
        {
            return ResponseController::respond(['error' => 'invalid token'], 401);
        }


        return ResponseController::respond([
            "Email" => $user->email,
            "AccountStatus" => $user->account_status,
            "TrialStatus" => $user->trial_status,
            "CreatedAt" => $user->created_at,
            "UpdatedAt" => $user->updated_at,
        ]);
    }
}
