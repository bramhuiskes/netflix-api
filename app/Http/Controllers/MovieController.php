<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MovieController extends Controller
{
    public static string $table = 'movies';
    public static function getMovies(Request $request)
    {
        $validate = ValidateRequest::validateMovieRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::get($validate->validated(), new Movie(), MovieController::$table);
    }

    public static function addMovie(Request $request)
    {
        $validate = ValidateRequest::validateMovieRequest($request, false);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::post($request->user(), $validate->validated(), new Movie(), MovieController::$table);
    }

    public static function deleteMovie(Request $request)
    {
        $validate = ValidateRequest::validateDeleteRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::delete($request->user(), $validate->validated(), new Movie(), MovieController::$table);
    }

    public static function updateMovie(Request $request)
    {
        $validate = ValidateRequest::validateMovieRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::patch($request->user(), $validate->validated(), new Movie(), MovieController::$table);
    }
}
