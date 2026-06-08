<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'company' => fake()->company(),
            'message' => fake()->paragraphs(2, true),
            'read_at' => fake()->optional(0.3)->dateTimeThisMonth(),
        ];
    }
}
