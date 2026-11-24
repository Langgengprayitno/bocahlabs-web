<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $title
 * @property-read string $desc
 */
class ProcessStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'icon',
        'title_id',
        'title_en',
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

    protected function title(): Attribute
    {
        return Attribute::get(
            fn (): string => app()->getLocale() === 'en' ? $this->title_en : $this->title_id
        );
    }

    protected function desc(): Attribute
    {
        return Attribute::get(
            fn (): string => app()->getLocale() === 'en' ? $this->desc_en : $this->desc_id
        );
    }
}