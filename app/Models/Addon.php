<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $name
 * @property-read string $desc
 * @property-read string $price_label
 */
class Addon extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'icon',
        'price_label_id',
        'price_label_en',
        'name_id',
        'name_en',
        'desc_id',
        'desc_en',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    protected function name(): Attribute
    {
        return Attribute::get(
            fn (): string => app()->getLocale() === 'en' ? $this->name_en : $this->name_id
        );
    }

    protected function desc(): Attribute
    {
        return Attribute::get(
            fn (): string => app()->getLocale() === 'en' ? $this->desc_en : $this->desc_id
        );
    }

    protected function priceLabel(): Attribute
    {
        return Attribute::get(
            fn (): string => app()->getLocale() === 'en' ? $this->price_label_en : $this->price_label_id
        );
    }
}