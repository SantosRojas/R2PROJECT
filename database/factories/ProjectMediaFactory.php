<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectMedia>
 */
class ProjectMediaFactory extends Factory
{
    protected $model = ProjectMedia::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['image', 'video', 'document']);

        return match ($type) {
            'video' => [
                'project_id' => Project::factory(),
                'type' => 'video',
                'url' => 'https://www.youtube.com/watch?v=' . fake()->regexify('[A-Za-z0-9_-]{11}'),
                'title' => fake()->sentence(3),
                'video_provider' => 'youtube',
                'video_id' => fake()->regexify('[A-Za-z0-9_-]{11}'),
                'sort_order' => fake()->numberBetween(0, 10),
            ],
            'document' => [
                'project_id' => Project::factory(),
                'type' => 'document',
                'url' => fake()->url() . '/documento.pdf',
                'title' => fake()->sentence(3),
                'sort_order' => fake()->numberBetween(0, 10),
            ],
            default => [
                'project_id' => Project::factory(),
                'type' => 'image',
                'url' => fake()->imageUrl(800, 600, 'business'),
                'title' => fake()->sentence(3),
                'sort_order' => fake()->numberBetween(0, 10),
            ],
        };
    }
}
