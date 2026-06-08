<x-layouts.app>

<x-slot:metaTitle>{{ $project->title }}</x-slot:metaTitle>
<x-slot:metaDescription>{{ $project->description }}</x-slot:metaDescription>

@php $mediaItems = $project->getMedia('gallery'); @endphp

<section class="py-24 bg-gradient-to-br from-gray-50 to-white dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('portfolio') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Volver al portafolio
            </a>
        </div>

        @if ($project->category)
            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 mb-4">
                {{ $project->category->name }}
            </span>
        @endif

        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900 dark:text-white mb-4">{{ $project->title }}</h1>

        <div class="flex flex-wrap gap-6 text-sm text-gray-500 dark:text-gray-400 mb-10">
            @if ($project->client_name)
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                    {{ $project->client_name }}
                </span>
            @endif
            @if ($project->completion_date)
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                    {{ $project->completion_date->format('M Y') }}
                </span>
            @endif
            @if ($project->project_url)
                <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 hover:underline">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                    Ver proyecto
                </a>
            @endif
        </div>

        @if ($mediaItems->isNotEmpty())
            @php $firstMedia = $mediaItems->shift(); @endphp
            <div class="rounded-2xl overflow-hidden mb-8 bg-gray-100 dark:bg-gray-800">
                @if (str_starts_with($firstMedia->mime_type, 'video/'))
                    <video controls class="w-full aspect-video object-cover">
                        <source src="{{ $firstMedia->getUrl() }}" type="{{ $firstMedia->mime_type }}">
                    </video>
                @else
                    <img src="{{ $firstMedia->getUrl() }}" alt="{{ $project->title }}" class="w-full aspect-video object-cover">
                @endif
            </div>
            @if ($mediaItems->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
                    @foreach ($mediaItems as $media)
                        <a href="{{ $media->getUrl() }}" target="_blank" class="rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 aspect-video">
                            @if (str_starts_with($media->mime_type, 'video/'))
                                <video class="w-full h-full object-cover">
                                    <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
                                </video>
                            @else
                                <img src="{{ $media->getUrl() }}" alt="" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</section>

<section class="py-16 bg-white dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($project->description)
            <div class="prose prose-gray dark:prose-invert max-w-none mb-8">
                <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">{{ $project->description }}</p>
            </div>
        @endif

        @if ($project->content)
            <div class="prose prose-gray dark:prose-invert max-w-none">
                {!! $project->content !!}
            </div>
        @endif
    </div>
</section>

@if ($moreProjects->isNotEmpty())
<section class="py-24 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-10">Más proyectos</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($moreProjects as $moreProject)
                <a href="{{ route('portfolio.show', $moreProject) }}" class="group block rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 hover:border-blue-500/50 dark:hover:border-blue-500/50 transition-all">
                    <div class="aspect-video bg-gray-100 dark:bg-gray-800 overflow-hidden">
                        @if ($moreProject->getFirstMediaUrl('thumbnail'))
                            <img src="{{ $moreProject->getFirstMediaUrl('thumbnail') }}" alt="{{ $moreProject->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" /></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $moreProject->title }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

</x-layouts.app>
