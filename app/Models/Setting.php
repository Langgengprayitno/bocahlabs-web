<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Mengambil satu nilai pengaturan berdasarkan key.
     */
    public static function getValue(string $key, ?string $default = null): ?string
    {
        $value = static::query()->where('key', $key)->value('value');

        return $value !== null ? (string) $value : $default;
    }

    /**
     * Mengambil seluruh pengaturan sebagai array [key => value].
     *
     * @return array<string, string|null>
     */
    public static function allAsMap(): array
    {
        return static::query()->pluck('value', 'key')->all();
    }
}