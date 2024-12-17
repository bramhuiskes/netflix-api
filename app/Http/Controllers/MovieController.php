<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\JsonResponse;

class MovieController extends Controller
{
    public static function getMovies(Request $request) : JsonResponse
    {
        $validate = ValidateRequest::validateMovieGetRequest($request);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        return ModelController::get($validate->validated(), new Movie(), "movies");
    }
}
