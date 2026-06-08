<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    private static array $names = [
        'Automatización de Procesos',
        'Transformación Digital',
        'Integraciones API',
        'Robótica de Procesos (RPA)',
        'Business Intelligence',
        'Workflows y BPM',
    ];

    private static int $index = 0;

    public function definition(): array
    {
        $name = self::$names[self::$index % count(self::$names)];
        self::$index++;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(),
            'icon' => fake()->randomElement(['cog', 'chart-bar', 'code-branch', 'robot', 'brain', 'arrows-spin']),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
