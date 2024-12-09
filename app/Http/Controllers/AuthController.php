<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;
use function PHPUnit\Framework\isInstanceOf;

class AuthController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        $user = DB::table('users')->where('email', $request->input('email'))->first();

        if (DB::table('users') == null)
        {
            return response()->json(['error' => 'database connection failed']);
        }

        if ($request->post('email') == null)
        {
            return response()->json(['error' => 'email not in header']);
        }

        if ($request->post('password') == null)
        {
            return response()->json(['error' => 'password not in header']);
        }

        if (!$user || !Hash::check($request->post('password'), $user->password)) {
            return response()->json(['error' => $user == null ? 'user not found' : 'invalid credentials'], 401);
        }

        $userObject = new User();
        $userObject->email = $request->post('email');
        $userObject->password = $request->post('password');

        $token = $userObject->createToken("API Token for {$request->post('email')}")->plainTextToken;

        $userObject->update();

        return response()->json(['token' => $token]);
    }

    public function register(Request $request) : JsonResponse
    {
        if ($request->post('email') == null)
        {
            return response()->json(['error' => 'email not in header']);
        }

        if ($request->post('password') == null)
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
