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

        if ($this->checkUserFields($validatedRequest) != null)
        {
            return $this->checkUserFields($validatedRequest);
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

        if (DB::table('users') -> where('email', $validatedRequest['email']) -> exists())
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

        DB::table('users')->insert(['email' => $request->input('email'), 'password' => Hash::make($request->input('password')), 'created_at' => now(), 'updated_at' => now()]);

        return response()->json(['msg' => 'user successfully registered', 'email' => $request->input('email')]);
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

        $user = DB::table('users')->where('email', $validatedRequest['email'])->first();

        if ($validatedRequest['email'] == null)
        {
            return response()->json(['error' => 'email not in header'], 422);
        }

        if ($validatedRequest['password'] == null)
        {
            return response()->json(['error' => 'password not in header'], 422);
        }

        if (!$user || !Hash::check($validatedRequest['password'], $user->password)) {
            return response()->json(['error' => $user == null ? 'user not found' : 'invalid credentials'], 401);
        }

        if ($validatedRequest['newPassword'] == null)
        {
            return response()->json(['error' => 'new password not in header'], 422);
        }

        if (!$user || !Hash::check($validatedRequest['password'], $user->password)) {
            return response()->json(['error' => $user == null ? 'user not found' : 'invalid credentials'], 401);
        }

        DB::table('users')
            ->where('email', $request->input('email'))
            ->update(['password' => Hash::make($request->input('newPassword'))]);

        return response()->json(['msg' => 'password successfully changed', 'email' => $request->input('email')]);
    }

    public function activateAccount(Request $request) : JsonResponse
    {
        $validator = ValidateRequest::validateUserRequest($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedRequest = $validator->validated();

        if ($this->checkUserFields($validatedRequest) != null)
        {
            return $this->checkUserFields($validatedRequest);
        }

        DB::table('users')
            ->where('email', $request->input('email'))
            ->update(['is_active' => 1]);

        return response()->json(['msg' => 'Activate status successfully changed', 'email' => $request->input('email')]);
    }

    public function blockAccount(Request $request) : JsonResponse
    {
        $validator = ValidateRequest::validateUserRequest($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedRequest = $validator->validated();

        if ($this->checkUserFields($validatedRequest) != null)
        {
            return $this->checkUserFields($validatedRequest);
        }

        DB::table('users')
            ->where('email', $request->input('email'))
            ->update(['is_blocked' => 1]);

        return response()->json(['msg' => 'Block status successfully changed', 'email' => $request->input('email')]);
    }

    public function checkUserFields(array $validatedRequest) : ?JsonResponse
    {
        $user = DB::table('users')->where('email', $validatedRequest['email'])->first();

        if ($validatedRequest['email'] == null)
        {
            return response()->json(['error' => 'email not in header'], 422);
        }

        if ($validatedRequest['password'] == null)
        {
            return response()->json(['error' => 'password not in header'], 422);
        }

        if (!$user || !Hash::check($validatedRequest['password'], $user->password)) {
            return response()->json(['error' => $user == null ? 'user not found' : 'invalid credentials'], 401);
        }

        return null;
    }
}
