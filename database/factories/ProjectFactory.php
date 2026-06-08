<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $title = fake()->randomElement([
            'Automatización de Facturación Electrónica',
            'Sistema de Gestión Documental Inteligente',
            'Chatbot de Atención al Cliente 24/7',
            'Dashboard de KPIs en Tiempo Real',
            'Integración ERP - CRM Automatizada',
            'Robot de Conciliación Bancaria',
            'Workflow de Aprobación de Compras',
            'Portal de Proveedores Automatizado',
            'Sistema de Notificaciones Inteligentes',
            'Automatización de Recursos Humanos',
            'Plataforma de Análisis de Datos',
            'Sistema de Gestión de Inventarios',
            'Automatización de Marketing Digital',
            'Onboarding Digital de Clientes',
            'Sistema de Firma Electrónica',
        ]);

        return [
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),
            'content' => fake()->paragraphs(3, true),
            'client_name' => fake()->company(),
            'completion_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'project_url' => fake()->optional()->url(),
            'is_featured' => fake()->boolean(30),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
