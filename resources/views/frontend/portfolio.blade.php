<x-layouts.app>

<x-slot:metaTitle>Portafolio</x-slot:metaTitle>
<x-slot:metaDescription>Explora nuestros proyectos de automatización de procesos digitales</x-slot:metaDescription>

<section class="py-24 bg-gradient-to-br from-gray-50 to-white dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900 dark:text-white">Portafolio</h1>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Conoce nuestros proyectos de automatización</p>
        </div>

        @if ($categories->isNotEmpty())
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <a href="{{ route('portfolio') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                Todos
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('portfolio', ['category' => $category->slug]) }}" class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ request('category') === $category->slug ? 'bg-blue-600 text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
        @endif

        @if ($projects->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($projects as $project)
                    <a href="{{ route('portfolio.show', $project) }}" class="group block rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 hover:border-blue-500/50 dark:hover:border-blue-500/50 transition-all hover:shadow-xl hover:shadow-blue-500/5">
                        <div class="aspect-video bg-gray-100 dark:bg-gray-800 overflow-hidden">
                            @if ($project->getFirstMediaUrl('thumbnail'))
                                <img src="{{ $project->getFirstMediaUrl('thumbnail') }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
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

            <div class="mt-12">
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-500 dark:text-gray-400">No hay proyectos disponibles en este momento.</p>
            </div>
        @endif
    </div>
</section>

</x-layouts.app>
