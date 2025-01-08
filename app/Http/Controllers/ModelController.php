<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;

class ModelController
{
    public static function get(User $user, array $validatedRequest, Model $model, string $table)
    {
        if (!$user->exists())
        {
            return ResponseController::respond(["error" => "User not found"], 404);
        }

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

    public static function post(User $user, array $validatedRequest, Model $model, string $table, $isAdminRightsRequired = true)
    {
        if (self::checkAdminRights($user, $isAdminRightsRequired) != null){
            return self::checkAdminRights($user, $isAdminRightsRequired);
        }

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

    public static function delete(User $user, array $validatedRequest, Model $model, string $table, $isAdminRightsRequired = true)
    {
        if (self::checkAdminRights($user, $isAdminRightsRequired) != null){
            return self::checkAdminRights($user, $isAdminRightsRequired);
        }

        if (self::checkId($validatedRequest, $model, $table) != null){
            return self::checkId($validatedRequest, $model, $table);
        }

        $model::where('id', $validatedRequest['id'])->delete();

        return ResponseController::respond(['msg' => 'Successfully deleted']);
    }

    public static function patch(User $user, array $validatedRequest, Model $model, string $table, $isAdminRightsRequired = true)
    {
        if (self::checkAdminRights($user, $isAdminRightsRequired) != null){
            return self::checkAdminRights($user, $isAdminRightsRequired);
        }

        if (self::checkId($validatedRequest, $model, $table) != null){
            return self::checkId($validatedRequest, $model, $table);
        }

        if (!isset($validatedRequest["id"]))
        {
            return ResponseController::respond(['error' => "Parameter 'id' is required"], 422);
        }

        if (!$model::where('id', $validatedRequest['id'])->exists())
        {
            return ResponseController::respond(['error' => "No data available where id={$validatedRequest['id']} in '{$table}'"], 422);
        }

        $model::where('id', $validatedRequest['id'])->update($validatedRequest);

        return ResponseController::respond(['msg' => 'Data successfully updated']);
    }

    private static function checkId(array $validatedRequest, Model $model, string $table)
    {
        if (!isset($validatedRequest["id"]))
        {
            return ResponseController::respond(['error' => "Parameter 'id' is required"], 422);
        }

        if (!$model::where('id', $validatedRequest['id'])->exists())
        {
            return ResponseController::respond(['error' => "No data available where id={$validatedRequest['id']} in '{$table}'"], 422);
        }

        return null;
    }

    private static function checkAdminRights(User $user, $isAdminRightsRequired)
    {
        if ($isAdminRightsRequired && (!$user->exists() || $user->role_id != 1))
        {
            return ResponseController::respond(['error' => "Unauthorized"], 401);
        }

        return null;
    }
}
