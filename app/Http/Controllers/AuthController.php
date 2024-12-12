<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ValidateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        $validator = ValidateRequest::validateUserRequest($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = UserValidatorController::checkUserWithoutToken($validator->validated());

        if ($user instanceof JsonResponse)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return response()->json(['error' => 'user not found'], 422);
        }

        if ($user->is_blocked == 1)
        {
            return response()->json(['error' => 'user is blocked'], 403);
        }

        $token = $user->createToken("API Token for {$user->email}")->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function register(Request $request) : JsonResponse
    {
        $validator = ValidateRequest::validateUserRequest($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedRequest = $validator->validated();

        if (User::where('email', $validatedRequest['email'])->exists())
        {
            return response()->json(['error' => 'email already exists']);
        }

        if ($validatedRequest['email'] == null)
        {
            return response()->json(['error' => 'email not in header']);
        }

        if ($validatedRequest['password'] == null)
        {
            return response()->json(['error' => 'password not in header']);
        }

        $user = new User();
        $user->email = $validatedRequest['email'];
        $user->password = Hash::make($validatedRequest['password']);
        $user->created_at = now();
        $user->updated_at = now();

        $user->save();

        return response()->json(['msg' => 'user successfully registered', 'email' => $user->email]);
    }

    public function logout(Request $request) : JsonResponse
    {

        return response()->json("");
    }

    public function passwordReset(Request $request) : JsonResponse
    {
        $validator = ValidateRequest::validateUserNewPassRequest($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedRequest = $validator->validated();

        $user = UserValidatorController::checkUserWithoutToken($validatedRequest);

        if ($user instanceof JsonResponse)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return response()->json(['error' => 'user not found'], 422);
        }

        if ($validatedRequest['newPassword'] == null)
        {
            return response()->json(['error' => 'new password not in header'], 422);
        }

        $user->password = Hash::make($validatedRequest['newPassword']);
        $user->updated_at = now();
        $user->update();

        return response()->json(['msg' => 'password successfully changed', 'email' => $request->input('email')]);
    }

    public function activateAccount(Request $request) : JsonResponse
    {
        $validator = ValidateRequest::validateUserRequestWithoutPass($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = UserValidatorController::checkUserWithToken($validator->validated());

        if ($user instanceof JsonResponse)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return response()->json(['error' => 'user not found'], 422);
        }

        if ($user->is_active == 1)
        {
            return response()->json(['msg' => 'account was already active']);
        }

        $user->is_active = 1;
        $user->updated_at = now();
        $user->update();

        return response()->json(['msg' => 'Activate status successfully changed', 'email' => $user->email]);
    }

    public function blockAccount(Request $request) : JsonResponse
    {
        $validator = ValidateRequest::validateUserRequestWithoutPass($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = UserValidatorController::checkUserWithToken($validator->validated());

        if ($user instanceof JsonResponse)
        {
            return $user;
        }

        if (!($user instanceof User))
        {
            return response()->json(['error' => 'user not found'], 422);
        }

        if ($user->is_blocked == 1)
        {
            return response()->json(['msg' => 'account was already blocked']);
        }

        $user->is_blocked = 1;
        $user->updated_at = now();
        $user->update();

        return response()->json(['msg' => 'Block status successfully changed', 'email' => $user->email]);
    }
}
