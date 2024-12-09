<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ValidateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) : JsonResponse
    {

        $validator = ValidateRequest::validateUserRequest($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedRequest = $validator->validated();

        if (!key_exists('email', $validatedRequest) || !key_exists('password', $validatedRequest)) {
            return response()->json(['error' => 'request invalid']);
        }

        $user = DB::table('users')->where('email', $validatedRequest['email'])->first();

        if (DB::table('users') == null)
        {
            return response()->json(['error' => 'database connection failed']);
        }

        if ($validatedRequest['email'] == null)
        {
            return response()->json(['error' => 'email not in header']);
        }

        if ($validatedRequest['password'] == null)
        {
            return response()->json(['error' => 'password not in header']);
        }

        if (!$user || !Hash::check($validatedRequest['password'], $user->password)) {
            return response()->json(['error' => $user == null ? 'user not found' : 'invalid credentials'], 401);
        }

        $userObject = new User();
        $userObject->email = $validatedRequest['email'];
        $userObject->password = $validatedRequest['password'];

        $token = $userObject->createToken("API Token for {$validatedRequest['email']}")->plainTextToken;

        $userObject->update();

        return response()->json(['token' => $token]);
    }

    public function register(Request $request) : JsonResponse
    {
        $validator = ValidateRequest::validateUserRequest($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedRequest = $validator->validated();

        if ($validatedRequest['email'] == null)
        {
            return response()->json(['error' => 'email not in header']);
        }

        if ($validatedRequest['password'] == null)
        {
            return response()->json(['error' => 'password not in header']);
        }

        DB::table('users')->insert(['email' => $request->input('email'), 'password' => Hash::make($request->input('password')), 'created_at' => now(), 'updated_at' => now()]);

        return response()->json(['msg' => 'user successfully registered', 'email' => $request->input('email')]);
    }

    public function logout(Request $request) : JsonResponse
    {
        return response()->json("");
    }

    public function passwordReset(Request $request) : JsonResponse
    {
        return response()->json("");
    }

    public function confirmPasswordReset(Request $request) : JsonResponse
    {
        return response()->json("");
    }

    public function activateAccount(Request $request) : JsonResponse
    {
        return response()->json("");
    }

    public function blockAccount(Request $request) : JsonResponse
    {
        return response()->json("");
    }
}
