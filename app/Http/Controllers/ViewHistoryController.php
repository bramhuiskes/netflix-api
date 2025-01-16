<?php

namespace App\Http\Controllers;

use App\Models\View_history;
use Illuminate\Http\Request;

class ViewHistoryController extends Controller
{
    public static string $table = 'view_histories';

    public function get(Request $request)
    {
        $validate = ValidateRequest::validateViewHistoryRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::get($request->user(), $validate->validated(), new View_history(), self::$table);
    }

    public function add(Request $request)
    {
        $validate = ValidateRequest::validateViewHistoryRequest($request, false);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::post($request->user(), $validate->validated(), new View_history(), self::$table, false);
    }

    public function delete(Request $request)
    {
        $validate = ValidateRequest::validateDeleteRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::delete($request->user(), $validate->validated(), new View_history(), self::$table, false);
    }

    public function update(Request $request)
    {
        $validate = ValidateRequest::validateViewHistoryRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::patch($request->user(), $validate->validated(), new View_history(), self::$table, false);
    }
}
