<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public static string $table = 'series';

    public function get(Request $request)
    {
        $validate = ValidateRequest::validateSerieRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::get($request->user(), $validate->validated(), new Serie(), self::$table);
    }

    public function add(Request $request)
    {
        $validate = ValidateRequest::validateSerieRequest($request, false);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::post($request->user(), $validate->validated(), new Serie(), self::$table, );
    }

    public function delete(Request $request)
    {
        $validate = ValidateRequest::validateDeleteRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::delete($request->user(), $validate->validated(), new Serie(), self::$table);
    }

    public function update(Request $request)
    {
        $validate = ValidateRequest::validateSerieRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::patch($request->user(), $validate->validated(), new Movie(), self::$table);
    }
}
