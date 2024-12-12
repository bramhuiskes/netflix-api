<?php
namespace App\Models;

use Illuminate\Support\Facades\Validator;

class ValidateRequest
{
    public static function validateUserRequestWithoutPass($request) : \Illuminate\Validation\Validator
    {
        $rules = [
            'email' => 'required|email'
        ];

        return Validator::make($request->all(), $rules);
    }
    public static function validateUserRequest($request) : \Illuminate\Validation\Validator
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        return Validator::make($request->all(), $rules);
    }
    public static function validateUserNewPassRequest($request) : \Illuminate\Validation\Validator
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'newPassword' => 'required',
        ];

        return Validator::make($request->all(), $rules);
    }


}
