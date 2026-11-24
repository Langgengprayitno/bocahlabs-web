<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read string $name
 * @property-read string $tier_label
 * @property-read string $tagline
 * @property-read array<int, string> $features
 */
class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'tier',
        'is_popular',
        'price_label',
        'price_min',
        'image_path',
        'name_id',
        'name_en',
        'tier_label_id',
        'tier_label_en',
        'tagline_id',
        'tagline_en',
        'features_id',
        'features_en',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
            'price_min' => 'integer',
            'sort_order' => 'integer',
            'features_id' => 'array',
            'features_en' => 'array',
        ];
    }

    /**
     * Relasi: satu paket bisa dipilih oleh banyak lead.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * Scope hanya paket yang aktif.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope urutkan berdasarkan sort_order lalu id.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Accessor nama paket sesuai locale aktif.
     */
    protected function name(): Attribute
    {
        return Attribute::get(
            fn (): string => app()->getLocale() === 'en' ? $this->name_en : $this->name_id
        );
    }

    /**
     * Accessor label tier sesuai locale aktif.
     */
    protected function tierLabel(): Attribute
    {
        return Attribute::get(
            fn (): string => app()->getLocale() === 'en' ? $this->tier_label_en : $this->tier_label_id
        );
    }

    /**
     * Accessor tagline paket sesuai locale aktif.
     */
    protected function tagline(): Attribute
    {
        return Attribute::get(
            fn (): string => app()->getLocale() === 'en' ? $this->tagline_en : $this->tagline_id
        );
    }

    /**
     * Accessor daftar fitur sesuai locale aktif.
     */
    protected function features(): Attribute
    {
        return Attribute::get(
            fn (): array => app()->getLocale() === 'en'
                ? ($this->features_en ?? [])
                : ($this->features_id ?? [])
        );
    }
}