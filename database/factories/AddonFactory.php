<?php

namespace Database\Factories;

use App\Models\Addon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Addon>
 */
class AddonFactory extends Factory
{
    protected $model = Addon::class;

    public function definition(): array
    {
        $name = 'Addon ' . fake()->words(2, true);

        return [
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 999),
            'icon' => 'sparkles',
            'price_label_id' => 'Rp 300.000',
            'price_label_en' => 'Rp 300,000',
            'name_id' => $name,
            'name_en' => $name . ' EN',
            'desc_id' => fake()->sentence(),
            'desc_en' => fake()->sentence(),
            'sort_order' => 1,
            'is_active' => true,
        ];
    }
}