<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Project;
use App\Models\ProjectMedia;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@r2project.com',
        ]);

        $categories = Category::factory(6)->create();

        $projectTitles = [
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
        ];

        $projectTitles = array_slice($projectTitles, 0, 12);

        foreach ($projectTitles as $i => $title) {
            $project = Project::create([
                'category_id' => $categories->random()->id,
                'title' => $title,
                'slug' => \Illuminate\Support\Str::slug($title),
                'description' => fake()->paragraph(),
                'content' => fake()->paragraphs(3, true),
                'client_name' => fake()->company(),
                'completion_date' => fake()->dateTimeBetween('-2 years', 'now'),
                'project_url' => fake()->boolean(30) ? fake()->url() : null,
                'is_featured' => $i < 4,
                'is_active' => true,
                'sort_order' => $i,
            ]);

            ProjectMedia::create([
                'project_id' => $project->id,
                'type' => 'image',
                'url' => 'https://placehold.co/800x600/2563EB/ffffff?text=' . urlencode($title),
                'title' => 'Imagen principal: ' . $title,
                'sort_order' => 0,
            ]);

            if ($i % 3 === 0) {
                ProjectMedia::create([
                    'project_id' => $project->id,
                    'type' => 'video',
                    'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'title' => 'Video demostrativo: ' . $title,
                    'video_provider' => 'youtube',
                    'video_id' => 'dQw4w9WgXcQ',
                    'sort_order' => 1,
                ]);
            }

            if ($i % 2 === 0) {
                ProjectMedia::create([
                    'project_id' => $project->id,
                    'type' => 'document',
                    'url' => '#',
                    'title' => 'Documento técnico: ' . $title,
                    'sort_order' => 2,
                ]);
            }
        }

        $testimonials = [
            ['Carlos Mendoza', 'CTO', 'TechCorp MX', 'Trabajar con R2PROJECT transformó nuestra operación. Redujimos tiempos de proceso en un 70% y eliminamos errores manuales completamente.', 5],
            ['María García', 'Directora de Operaciones', 'LogiSolutions', 'La automatización de nuestros workflows de aprobación fue impecable. El equipo entendió nuestras necesidades desde el día uno.', 5],
            ['José Hernández', 'CEO', 'InnovaTech', 'Implementaron un sistema de integración ERP-CRM que nos ahorró más de 200 horas hombre al mes. Altamente recomendados.', 5],
            ['Ana Paola Ruiz', 'Gerente de TI', 'Grupo Financiero BX+', 'La conciliación bancaria automatizada es exactamente lo que necesitábamos. Precisión del 99.9% desde el primer mes.', 4],
            ['Roberto Sánchez', 'Director de Innovación', 'SaludDigital', 'El chatbot de atención que desarrollaron elevó nuestra satisfacción al cliente en un 40%. Increíble resultados.', 5],
        ];

        foreach ($testimonials as $i => [$name, $position, $company, $content, $rating]) {
            Testimonial::create([
                'client_name' => $name,
                'client_position' => $position,
                'client_company' => $company,
                'content' => $content,
                'rating' => $rating,
                'is_active' => true,
                'sort_order' => $i,
            ]);
        }

        Contact::factory(5)->create();

        $settings = [
            'site_name' => 'R2PROJECT',
            'site_description' => 'Automatización de Procesos Digitales para Empresas',
            'primary_color' => '#2563EB',
            'secondary_color' => '#1E40AF',
            'accent_color' => '#F59E0B',
            'email' => 'contacto@r2project.com',
            'phone' => '+52 55 1234 5678',
            'address' => 'Ciudad de México, MX',
            'facebook_url' => 'https://facebook.com/r2project',
            'linkedin_url' => 'https://linkedin.com/company/r2project',
            'instagram_url' => 'https://instagram.com/r2project',
            'meta_title' => 'R2PROJECT - Automatización de Procesos Digitales',
            'meta_description' => 'Transformamos la gestión empresarial con automatización de procesos digitales, RPA e integraciones API.',
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
    }
}
