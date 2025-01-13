<?php

namespace App\Http\Controllers;

use App\Models\Subscription_type;
use Illuminate\Http\Request;

class SubscriptionTypeController extends Controller
{
    public static string $table = 'subscription_types';

    public function get(Request $request)
    {
        $validate = ValidateRequest::validateSubscriptionTypeRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::get($request->user(), $validate->validated(), new Subscription_type(), self::$table);
    }

    public function add(Request $request)
    {
        $validate = ValidateRequest::validateSubscriptionTypeRequest($request, false);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::post($request->user(), $validate->validated(), new Subscription_type(), self::$table);
    }

    public function delete(Request $request)
    {
        $validate = ValidateRequest::validateDeleteRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::delete($request->user(), $validate->validated(), new Subscription_type(), self::$table);
    }

    public function update(Request $request)
    {
        $validate = ValidateRequest::validateSubscriptionTypeRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::patch($request->user(), $validate->validated(), new Subscription_type(), self::$table);
    }
}
