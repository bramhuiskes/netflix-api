<?php

namespace App\Http\Controllers;

use App\Models\Subtitle;
use Illuminate\Http\Request;

class SubtitleController extends Controller
{
    public static string $table = 'subtitles';
    public function get(Request $request)
    {
        $validate = ValidateRequest::validateSubtitleRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::get($request->user(), $validate->validated(), new Subtitle(), self::$table);
    }

    public function add(Request $request)
    {
        $validate = ValidateRequest::validateSubtitleRequest($request, false);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::post($request->user(), $validate->validated(), new Subtitle(), self::$table);
    }

    public function delete(Request $request)
    {
        $validate = ValidateRequest::validateDeleteRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::delete($request->user(), $validate->validated(), new Subtitle(), self::$table);
    }

    public function update(Request $request)
    {
        $validate = ValidateRequest::validateSubtitleRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::patch($request->user(), $validate->validated(), new Subtitle(), self::$table);
    }
}
