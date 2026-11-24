<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Faq>
 */
class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition(): array
    {
        return [
            'question_id' => fake()->sentence() . '?',
            'question_en' => fake()->sentence() . '?',
            'answer_id' => fake()->paragraph(),
            'answer_en' => fake()->paragraph(),
            'sort_order' => 1,
            'is_active' => true,
        ];
    }
}