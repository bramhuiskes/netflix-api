<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public static string $table = 'users';
    public function login(Request $request)
    {
        $validatorOutput = self::validateUserRequest($request);
        if (!$validatorOutput instanceof \Illuminate\Validation\Validator) {
            return $validatorOutput;
        }

        $checkUserOutput = self::checkUser($validatorOutput, false);
        if (!$checkUserOutput instanceof User) {
            return $checkUserOutput;
        }

        $token = $checkUserOutput->createToken("API Token for {$checkUserOutput->email}")->plainTextToken;

        return ResponseController::respond(['token' => $token]);
    }

    public function loginWithoutPasswordCheck(Request $request)
    {
        $validatorOutput = self::validateUserRequestWithoutPass($request);
        if (!$validatorOutput instanceof \Illuminate\Validation\Validator) {
            return $validatorOutput;
        }

        $checkUserOutput = self::checkUser($validatorOutput);
        if (!$checkUserOutput instanceof User) {
            return $checkUserOutput;
        }

        return ResponseController::respond(['psw' => User::where('email', $checkUserOutput->email)->first()["password"]]);
    }

    public function register(Request $request)
    {
        $validatorOutput = self::validateUserRequest($request);
        if (!$validatorOutput instanceof \Illuminate\Validation\Validator) {
            return $validatorOutput;
        }

        $validatedRequest = $validatorOutput->validated();

        if (User::where('email', $validatedRequest['email'])->exists()) {
            return ResponseController::respond(['error' => 'email already exists'], 409);
        }

        if ($validatedRequest['email'] == null) {
            return ResponseController::respond(['error' => 'email not in header'], 400);
        }

        if ($validatedRequest['password'] == null) {
            return ResponseController::respond(['error' => 'password not in header'], 400);
        }

        $user = User::create([
            "email"=> $validatedRequest['email'],
            "password" => Hash::make($validatedRequest['password'])
        ]);
        $user->save();
        $token = $user->createToken("API Token for {$user->email}")->plainTextToken;
        return ResponseController::respond(['token' => $token]);
    }

    public function passwordReset(Request $request)
    {
        $validatorOutput = self::validateUserRequestNewPass($request);
        if (!$validatorOutput instanceof \Illuminate\Validation\Validator) {
            return $validatorOutput;
        }

        $validatedRequest = $validatorOutput->validated();

        $checkUserOutput = self::checkUser($validatorOutput, false);
        if (!$checkUserOutput instanceof User) {
            return $checkUserOutput;
        }

        $checkUserOutput->password = Hash::make($validatedRequest['newPassword']);
        $checkUserOutput->update();

        return ResponseController::respond(['msg' => 'password successfully changed']);
    }

    public function activateAccount(Request $request)
    {
        $validatorOutput = self::validateUserRequestWithoutPass($request);
        if (!$validatorOutput instanceof \Illuminate\Validation\Validator) {
            return $validatorOutput;
        }

        $checkUserOutput = self::checkUser($validatorOutput);
        if (!$checkUserOutput instanceof User) {
            return $checkUserOutput;
        }

        if (!ValidateRequest::isTokenForUser($request, $checkUserOutput))
        {
            return ResponseController::respond(['error' => 'invalid token'], 401);
        }

        return ModelController::patch($request->user(), ['is_active' => 1, 'account_status' => 'Active', 'id' => $checkUserOutput->id], $checkUserOutput, self::$table, false);
    }

    public function blockAccount(Request $request)
    {
        $validatorOutput = self::validateUserRequestWithoutPass($request);
        if (!$validatorOutput instanceof \Illuminate\Validation\Validator) {
            return $validatorOutput;
        }

        $checkUserOutput = self::checkUser($validatorOutput, true, false);
        if (!$checkUserOutput instanceof User) {
            return $checkUserOutput;
        }

        if (!ValidateRequest::isTokenForUser($request, $checkUserOutput))
        {
            return ResponseController::respond(['error' => 'invalid token'], 401);
        }

        return ModelController::patch($request->user(), ['is_blocked' => 1, 'account_status' => 'Blocked', 'id' => $checkUserOutput->id], $checkUserOutput, self::$table, false);
    }

    public function unblockAccount(Request $request)
    {
        $validatorOutput = self::validateUserRequestWithoutPass($request);
        if (!$validatorOutput instanceof \Illuminate\Validation\Validator) {
            return $validatorOutput;
        }

        $checkUserOutput = self::checkUser($validatorOutput, true, false);
        if (!$checkUserOutput instanceof User) {
            return $checkUserOutput;
        }

        if (!ValidateRequest::isTokenForUser($request, $checkUserOutput))
        {
            return ResponseController::respond(['error' => 'invalid token'], 401);
        }

        return ModelController::patch($request->user(), ['is_blocked' => 0, 'account_status' => 'Active', 'id' => $checkUserOutput->id], $checkUserOutput, self::$table);
    }
    private function validateUserRequestNewPass(Request $request)
    {
        $validator = ValidateRequest::validateUserNewPassRequest($request);

        if ($validator->fails()) {
            return ResponseController::respond(['errors' => $validator->errors()], 422);
        }

        return $validator;
    }

    private function validateUserRequest(Request $request)
    {
        $validator = ValidateRequest::validateUserRequest($request);

        if ($validator->fails()) {
            return ResponseController::respond(['errors' => $validator->errors()], 422);
        }

        return $validator;
    }

    private function validateUserRequestWithoutPass(Request $request)
    {
        $validator = ValidateRequest::validateUserRequestWithoutPass($request);

        if ($validator->fails()) {
            return ResponseController::respond(['errors' => $validator->errors()], 422);
        }

        return $validator;
    }

    private function checkUser($validator, bool $usingToken = true, bool $usingBlockStateCheck = true)
    {
        if ($usingToken) {
            $userOutput = UserValidatorController::checkUserWithToken($validator->validated());
        } else {
            $userOutput = UserValidatorController::checkUserWithoutToken($validator->validated());
        }

        if ($userOutput instanceof Response) {
            return $userOutput;
        }

        if (!($userOutput instanceof User)) {
            return ResponseController::respond(['error' => 'user not found'], 404);
        }

        if ($usingBlockStateCheck) {
            if ($userOutput->is_blocked == 1) {
                return ResponseController::respond(['error' => 'user is blocked'], 403);
            }
        }

        return $userOutput;
    }
}
