<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Package>
 */
class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        $name = 'Paket ' . fake()->words(2, true);

        return [
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 999),
            'tier' => fake()->randomElement(['beginner', 'professional']),
            'is_popular' => false,
            'price_label' => 'Rp 2.500.000',
            'price_min' => 2500000,
            'image_path' => 'images/packages/compro-mini.webp',
            'name_id' => $name,
            'name_en' => $name . ' EN',
            'tier_label_id' => 'Kelas Beginner',
            'tier_label_en' => 'Beginner Tier',
            'tagline_id' => fake()->sentence(),
            'tagline_en' => fake()->sentence(),
            'features_id' => ['Desain responsif', 'Integrasi WhatsApp'],
            'features_en' => ['Responsive design', 'WhatsApp integration'],
            'sort_order' => 1,
            'is_active' => true,
        ];
    }
}