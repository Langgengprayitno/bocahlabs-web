<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $question
 * @property-read string $answer
 */
class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'question_en',
        'answer_id',
        'answer_en',
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

    protected function question(): Attribute
    {
        return Attribute::get(
            fn (): string => app()->getLocale() === 'en' ? $this->question_en : $this->question_id
        );
    }

    protected function answer(): Attribute
    {
        return Attribute::get(
            fn (): string => app()->getLocale() === 'en' ? $this->answer_en : $this->answer_id
        );
    }
}