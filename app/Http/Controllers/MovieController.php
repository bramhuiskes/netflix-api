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

        return ModelController::post($validate->validated(), new Movie(), MovieController::$table);
    }

    public static function deleteMovie(Request $request)
    {
        $validate = ValidateRequest::validateDeleteRequest($request);

        if ($validate->fails()) {
            return ResponseController::respond(['errors' => $validate->errors()], 422);
        }

        return ModelController::delete($validate->validated(), new Movie(), MovieController::$table, 'movie_id');
    }


}
