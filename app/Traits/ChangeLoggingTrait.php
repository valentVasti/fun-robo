<?php

namespace App\Traits;

use App\Models\ChangeLogs;

trait ChangeLoggingTrait
{
    public static function bootChangeLoggingTrait()
    {
        static::created(function ($model) {
            self::createChangeLog($model, 'created');
        });

        static::updated(function ($model) {
            self::createChangeLog($model, 'updated');
        });

        static::deleted(function ($model) {
            self::createChangeLog($model, 'deleted');
        });
    }

    protected static function createChangeLog($model, $action)
    {
        $color = "";

        switch ($action) {
            case 'created':
                $color = "#008282";
                break;

            case 'updated':
                $color = "#008CAA";
                break;

            case 'deleted':
                $color = "#FF3C78";
                break;

            default:
                # code...
                break;
        }

        $jsonData = $model->toJson();
        $arrayJsonData = json_decode($jsonData, true);
        $arrayOriginalData = "";

        if (is_array($arrayJsonData)) {
            $arrayJsonData = json_encode($arrayJsonData);
        }

        if (count($model->getOriginal()) > 0) {
            $originalData = $model->getOriginal();

            if (is_array($originalData)) {
                $arrayOriginalData = json_encode($originalData);
            }
        }

        ChangeLogs::create([
            'table_name' => $model->getTable(),
            'action' => $action,
            'old_data' => ($action === 'deleted') ? $arrayJsonData : $arrayOriginalData,
            'new_data' => ($action === 'created' || $action === 'updated') ? $arrayJsonData : null,
            'user_id' => auth()->id(),
            'color' => $color
        ]);
    }
}
