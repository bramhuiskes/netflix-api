<?php
namespace App\Models;

use Illuminate\Http\JsonResponse;

class TokenValidator
{
    public static function validate(string $token) : bool
    {
        return ($token == "testToken");
    }
}
