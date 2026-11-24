<?php

namespace Database\Factories;

use App\Models\ProcessStep;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProcessStep>
 */
class ProcessStepFactory extends Factory
{
    protected $model = ProcessStep::class;

    public function definition(): array
    {
        return [
            'number' => '01',
            'icon' => 'message-square',
            'title_id' => fake()->words(3, true),
            'title_en' => fake()->words(3, true),
            'desc_id' => fake()->sentence(),
            'desc_en' => fake()->sentence(),
            'sort_order' => 1,
            'is_active' => true,
        ];
    }
}