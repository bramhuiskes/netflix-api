<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public static string $table = 'episodes';
    public function get(Request $request)
    {
        $validate = ValidateRequest::validateEpisodeRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::get($request->user(), $validate->validated(), new Episode(), self::$table);
    }

    public function add(Request $request)
    {
        $validate = ValidateRequest::validateEpisodeRequest($request, false);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::post($request->user(), $validate->validated(), new Episode(), self::$table);
    }

    public function delete(Request $request)
    {
        $validate = ValidateRequest::validateDeleteRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::delete($request->user(), $validate->validated(), new Episode(), self::$table);
    }

    public function update(Request $request)
    {
        $validate = ValidateRequest::validateEpisodeRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::patch($request->user(), $validate->validated(), new Episode(), self::$table);
    }
}
