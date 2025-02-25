<?php

namespace App\Shared\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait HasBinaryUUID
{
    public static function bootGeneratesUuid()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = DB::raw("UUID_TO_BIN('" . Str::uuid() . "')");
            }
        });
    }

    public function getIdAttribute($value)
    {
        return DB::selectOne("SELECT BIN_TO_UUID(?) AS uuid", [ $value ])->uuid;
    }
}
