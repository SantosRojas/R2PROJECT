<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'client_name' => fake()->name(),
            'client_position' => fake()->jobTitle(),
            'client_company' => fake()->company(),
            'content' => fake()->paragraphs(2, true),
            'rating' => fake()->numberBetween(4, 5),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
