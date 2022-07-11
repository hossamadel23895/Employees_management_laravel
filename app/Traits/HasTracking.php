<?php

namespace App\Traits;


trait HasTracking
{
    public static function bootHasTracking() : void
    {
        static::creating(function ($model){
            $model->created_by = auth()->id() ?? 1;
            $model->updated_by = auth()->id() ?? 1;
        });

        static::updating(function ($model){
            $model->updated_by = auth()->id() ?? 1;
        });
    }
}
