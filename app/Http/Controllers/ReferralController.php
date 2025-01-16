<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public static string $table = 'referrals';

    public function get(Request $request)
    {
        $validate = ValidateRequest::validateReferralRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::get($request->user(), $validate->validated(), new Referral(), self::$table);
    }

    public function add(Request $request)
    {
        $validate = ValidateRequest::validateReferralRequest($request, false);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::post($request->user(), $validate->validated(), new Referral(), self::$table);
    }

    public function delete(Request $request)
    {
        $validate = ValidateRequest::validateDeleteRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::delete($request->user(), $validate->validated(), new Referral(), self::$table);
    }

    public function update(Request $request)
    {
        $validate = ValidateRequest::validateReferralRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::patch($request->user(), $validate->validated(), new Referral(), self::$table);
    }
}
