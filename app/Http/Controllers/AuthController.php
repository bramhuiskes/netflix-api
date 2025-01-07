<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ResponseController;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = ValidateRequest::validateUserRequest($request);

        if ($validator->fails()) {
            return ResponseController::respond(['errors' => $validator->errors()], 422);
        }

        $user = UserValidatorController::checkUserWithoutToken($validator->validated());

        if ($user instanceof Response)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return ResponseController::respond(['error' => 'user not found'], 422);
        }

        if ($user->is_blocked == 1)
        {
            return ResponseController::respond(['error' => 'user is blocked'], 403);
        }

        $token = $user->createToken("API Token for {$user->email}")->plainTextToken;

        return ResponseController::respond(['token' => $token]);
    }

    public function loginWithoutPasswordCheck(Request $request)
    {
        $validator = ValidateRequest::validateUserRequestWithoutPass($request);

        if ($validator->fails()) {
            return ResponseController::respond(['errors' => $validator->errors()], 422);
        }

        $user = UserValidatorController::checkUserWithToken($validator->validated());

        if ($user instanceof Response)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return ResponseController::respond(['error' => 'user not found'], 422);
        }

        if ($user->is_blocked == 1)
        {
            return ResponseController::respond(['error' => 'user is blocked'], 403);
        }

        return ResponseController::respond(['psw' => User::where('email', $user->email)->first()["password"]]);
    }

    public function register(Request $request)
    {
        $validator = ValidateRequest::validateUserRequest($request);

        if ($validator->fails()) {
            return ResponseController::respond(['errors' => $validator->errors()], 422);
        }

        $validatedRequest = $validator->validated();

        if (User::where('email', $validatedRequest['email'])->exists())
        {
            return ResponseController::respond(['error' => 'email already exists']);
        }

        if ($validatedRequest['email'] == null)
        {
            return ResponseController::respond(['error' => 'email not in header']);
        }

        if ($validatedRequest['password'] == null)
        {
            return ResponseController::respond(['error' => 'password not in header']);
        }

        $user = new User();
        $user->email = $validatedRequest['email'];
        $user->password = Hash::make($validatedRequest['password']);
        $user->created_at = now();
        $user->updated_at = now();

        $user->save();

        return ResponseController::respond(['msg' => 'user successfully registered', 'email' => $user->email]);
    }

    public function logout(Request $request)
    {

        return ResponseController::respond("");
    }

    public function passwordReset(Request $request)
    {
        $validator = ValidateRequest::validateUserNewPassRequest($request);

        if ($validator->fails()) {
            return ResponseController::respond(['errors' => $validator->errors()], 422);
        }

        $validatedRequest = $validator->validated();

        $user = UserValidatorController::checkUserWithoutToken($validatedRequest);

        if ($user instanceof Response)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return ResponseController::respond(['error' => 'user not found'], 422);
        }

        if ($validatedRequest['newPassword'] == null)
        {
            return ResponseController::respond(['error' => 'new password not in header'], 422);
        }

        $user->password = Hash::make($validatedRequest['newPassword']);
        $user->updated_at = now();
        $user->update();

        return ResponseController::respond(['msg' => 'password successfully changed', 'email' => $request->input('email')]);
    }

    public function activateAccount(Request $request)
    {
        $validator = ValidateRequest::validateUserRequestWithoutPass($request);

        if ($validator->fails()) {
            return ResponseController::respond(['errors' => $validator->errors()], 422);
        }

        $user = UserValidatorController::checkUserWithToken($validator->validated());

        if ($user instanceof Response)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return ResponseController::respond(['error' => 'user not found'], 422);
        }

        if (!ValidateRequest::isTokenForUser($request, $user))
        {
            return ResponseController::respond(['error' => 'invalid token'], 403);
        }

        if ($user->is_active == 1)
        {
            return ResponseController::respond(['msg' => 'account was already active']);
        }

        $user->is_active = 1;
        $user->updated_at = now();
        $user->update();

        return ResponseController::respond(['msg' => 'Activate status successfully changed', 'email' => $user->email]);
    }

    public function blockAccount(Request $request)
    {
        $validator = ValidateRequest::validateUserRequestWithoutPass($request);

        if ($validator->fails()) {
            return ResponseController::respond(['errors' => $validator->errors()], 422);
        }

        $user = UserValidatorController::checkUserWithToken($validator->validated());

        if ($user instanceof Response)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return ResponseController::respond(['error' => 'user not found'], 422);
        }

        if (!ValidateRequest::isTokenForUser($request, $user))
        {
            return ResponseController::respond(['error' => 'invalid token'], 403);
        }

        if ($user->is_blocked == 1)
        {
            return ResponseController::respond(['msg' => 'account was already blocked']);
        }

        $user->is_blocked = 1;
        $user->updated_at = now();
        $user->update();

        return ResponseController::respond(['msg' => 'Block status successfully changed', 'email' => $user->email]);
    }
}
