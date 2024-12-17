<?php

namespace App\Http\Controllers;

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

    public static function post(array $validatedRequest, Model $model, string $table) : JsonResponse
    {
        if ($model::where($validatedRequest)->exists())
        {
            return response()->json(['error' => "Data already exists in '{$table}'"], 422);
        }

        foreach ($validatedRequest as $key => $value) {
            if (!Schema::hasColumn($table, $key)) {
                return response()->json(['error' => "Parameter '{$key}' isn't valid with table '{$table}'"], 422);
            }

            $model->$key = $value;
        }

        $model->save();

        return response()->json(['msg' => 'Successfully saved', 'model' => $model]);
    }

    public static function delete(array $validatedRequest, Model $model, string $table, string $idTableName) : JsonResponse
    {
        if (!isset($validatedRequest["id"])) {
            return response()->json(['error' => "Parameter 'id' is required"], 422);
        }

        if (!$model::where($idTableName, $validatedRequest['id'])->exists())
        {
            return response()->json(['error' => "No data available where id={$validatedRequest['id']} in '{$table}'"], 422);
        }

        $model::where($idTableName, $validatedRequest['id'])->delete();

        return response()->json(['msg' => 'Successfully deleted']);
    }
}
