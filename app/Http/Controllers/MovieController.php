<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MovieController extends Controller
{
    public static string $table = 'movies';
    public function get(Request $request)
    {
        $validate = ValidateRequest::validateMovieRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::get($request->user(), $validate->validated(), new Movie(), self::$table);
    }

    public function add(Request $request)
    {
        $validate = ValidateRequest::validateMovieRequest($request, false);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::post($request->user(), $validate->validated(), new Movie(), self::$table);
    }

    public function delete(Request $request)
    {
        $validate = ValidateRequest::validateDeleteRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::delete($request->user(), $validate->validated(), new Movie(), self::$table);
    }

    public function update(Request $request)
    {
        $validate = ValidateRequest::validateMovieRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 400);
        }

        return ModelController::patch($request->user(), $validate->validated(), new Movie(), self::$table);
    }
}
