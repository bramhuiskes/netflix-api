<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;

class ModelController
{
    public static function get(array $validatedRequest, Model $model, string $table) : JsonResponse
    {
        $query = $model::query();

        foreach ($validatedRequest as $key => $value) {
            if (!Schema::hasColumn($table, $key)) {
                return response()->json(['error' => "Parameter '{$key}' isn't valid with table '{$table}'"], 422);
            }

            $query->where($key, 'like', "%{$value}%");
        }

        $movies = $query->get();

        return response()->json($movies);
    }
}
