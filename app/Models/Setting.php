<?php

namespace App\Models;

use Database\Factories\SettingFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable(['key', 'value'])]
class Setting extends Model
{
    /** @use HasFactory<SettingFactory> */
    use HasFactory;

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget('settings');
        });

        static::deleted(function () {
            Cache::forget('settings');
        });
    }

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever('settings', function () {
            return static::pluck('value', 'key')->all();
        })[$key] ?? $default;
    }

    public static function setValue(string $key, mixed $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    public static function getAll(): array
    {
        return Cache::rememberForever('settings', function () {
            return static::pluck('value', 'key')->all();
        });
    }
}
