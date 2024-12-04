<?php
namespace App\Http\Controllers;

use App\Models\TokenValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public TokenValidator $tokenValidator;

    public function __construct(){
        $this->tokenValidator = new TokenValidator();
    }

    public function checkToken(Request $request)
    {
        $token = $request->query('token');
        return $this->tokenValidator->validate($token);
    }
}
