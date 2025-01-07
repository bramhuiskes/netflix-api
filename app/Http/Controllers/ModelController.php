<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ModelController
{
    public static function get(array $validatedRequest, Model $model, string $table)
    {
        $query = $model::query();

        foreach ($validatedRequest as $key => $value) {
            if (!Schema::hasColumn($table, $key)) {
                return ResponseController::respond(['error' => "Parameter '{$key}' isn't valid with table '{$table}'"], 422);
            }

            $query->where($key, 'like', "%{$value}%");
        }

        $movies = $query->get();

        return ResponseController::respond($movies);
    }

    public static function post(array $validatedRequest, Model $model, string $table)
    {
        if ($model::where($validatedRequest)->exists())
        {
            return ResponseController::respond(['error' => "Data already exists in '{$table}'"], 422);
        }

        foreach ($validatedRequest as $key => $value) {
            if (!Schema::hasColumn($table, $key)) {
                return ResponseController::respond(['error' => "Parameter '{$key}' isn't valid with table '{$table}'"], 422);
            }

            $model->$key = $value;
        }

        $model->save();

        return ResponseController::respond(['msg' => 'Successfully saved', 'model' => $model]);
    }

    public static function delete(array $validatedRequest, Model $model, string $table, string $idTableName)
    {
        if (!isset($validatedRequest["id"])) {
            return ResponseController::respond(['error' => "Parameter 'id' is required"], 422);
        }

        if (!$model::where($idTableName, $validatedRequest['id'])->exists())
        {
            return ResponseController::respond(['error' => "No data available where id={$validatedRequest['id']} in '{$table}'"], 422);
        }

        $model::where($idTableName, $validatedRequest['id'])->delete();

        return ResponseController::respond(['msg' => 'Successfully deleted']);
    }
}
