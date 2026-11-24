<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'brand_name' => fake()->company(),
            'package_id' => Package::factory(),
            'addon_ids' => [],
            'lang' => 'id',
            'message' => 'Halo BocahLabs, saya ingin konsultasi pembuatan website.',
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'status' => Lead::STATUS_BARU,
        ];
    }
}