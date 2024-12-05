<?php
namespace App\Http\Controllers;

use App\Models\TokenCreator;
use App\Models\TokenValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TokenController extends Controller
{

    public function checkToken(Request $request) : JsonResponse
    {
        return  response()->json((new TokenValidator())->validate($request->query("token")));
    }

    public function createToken(Request $request) : JsonResponse
    {
        return response()->json(["token" => (new TokenCreator())->createToken()]);
    }

}
