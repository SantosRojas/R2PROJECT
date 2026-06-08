@php
    $heroTitle = \App\Models\Setting::getValue('hero_title', 'Automatización de Procesos Digitales');
    $heroSubtitle = \App\Models\Setting::getValue('hero_subtitle', 'Transformamos tus procesos manuales en soluciones digitales eficientes, escalables y seguras.');
    $heroCta = \App\Models\Setting::getValue('hero_cta', 'Ver proyectos');
@endphp

<x-layouts.app>

<x-slot:metaTitle>{{ $heroTitle }}</x-slot:metaTitle>
<x-slot:metaDescription>{{ $heroSubtitle }}</x-slot:metaDescription>

<section class="relative min-h-[90vh] flex items-center bg-gradient-to-br from-gray-50 to-white dark:from-gray-950 dark:to-gray-900">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-500/10 dark:bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-indigo-500/10 dark:bg-indigo-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="max-w-3xl">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900 dark:text-white leading-tight">
                {{ $heroTitle }}
            </h1>
            <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-gray-400 leading-relaxed max-w-2xl">
                {{ $heroSubtitle }}
            </p>
            <div class="mt-10 flex gap-4">
                <a href="{{ route('portfolio') }}" class="inline-flex items-center px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition-colors shadow-lg shadow-blue-600/25">
                    {{ $heroCta }}
                    <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
                <a href="#contacto" class="inline-flex items-center px-6 py-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    Contáctanos
                </a>
            </div>
        </div>
    </div>
</section>

@if ($featuredProjects->isNotEmpty())
<section class="py-24 bg-white dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">Proyectos destacados</h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Conoce algunos de nuestros trabajos recientes</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($featuredProjects as $project)
                <a href="{{ route('portfolio.show', $project) }}" class="group block rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 hover:border-blue-500/50 dark:hover:border-blue-500/50 transition-all hover:shadow-xl hover:shadow-blue-500/5">
                    <div class="aspect-video bg-gray-100 dark:bg-gray-800 overflow-hidden">
                        @if ($project->getFirstMediaUrl('thumbnail'))
                            <img src="{{ $project->getFirstMediaUrl('thumbnail') }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-600">
                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        @if ($project->category)
                            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 mb-3">
                                {{ $project->category->name }}
                            </span>
                        @endif
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $project->title }}</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $project->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('portfolio') }}" class="inline-flex items-center px-6 py-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                Ver todos los proyectos
                <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

@if ($testimonials->isNotEmpty())
<section class="py-24 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">Lo que dicen nuestros clientes</h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">La satisfacción de nuestros clientes es nuestra mejor carta de presentación</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($testimonials as $testimonial)
                <div class="p-6 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 {{ $i < $testimonial->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="text-gray-600 dark:text-gray-400 italic mb-4">&ldquo;{{ $testimonial->content }}&rdquo;</blockquote>
                    <div class="flex items-center gap-3">
                        @if ($testimonial->getFirstMediaUrl('avatar'))
                            <img src="{{ $testimonial->getFirstMediaUrl('avatar', 'thumb') }}" alt="{{ $testimonial->client_name }}" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 font-semibold text-sm">
                                {{ substr($testimonial->client_name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-medium text-sm text-gray-900 dark:text-white">{{ $testimonial->client_name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-500">{{ $testimonial->client_position }}{{ $testimonial->client_company ? ', ' . $testimonial->client_company : '' }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section id="contacto" class="py-24 bg-white dark:bg-gray-950">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">Contáctanos</h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Cuéntanos sobre tu proyecto y te contactaremos a la brevedad</p>
        </div>

        <div class="rounded-2xl border border-gray-200 dark:border-gray-800 p-8">
            @livewire('contact-form')
        </div>
    </div>
</section>

</x-layouts.app>
