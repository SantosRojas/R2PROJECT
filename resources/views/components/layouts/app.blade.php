@php
    $siteName = \App\Models\Setting::getValue('site_name', 'R2PROJECT');
    $siteDescription = \App\Models\Setting::getValue('site_description', 'Automatización de procesos digitales');
    $metaTitle = $metaTitle ?? \App\Models\Setting::getValue('meta_title', $siteName);
    $metaDescription = $metaDescription ?? \App\Models\Setting::getValue('meta_description', $siteDescription);
    $primaryColor = \App\Models\Setting::getValue('primary_color', '#2563EB');
    $secondaryColor = \App\Models\Setting::getValue('secondary_color', '#1E40AF');
    $accentColor = \App\Models\Setting::getValue('accent_color', '#F59E0B');
    $email = \App\Models\Setting::getValue('email');
    $phone = \App\Models\Setting::getValue('phone');
    $address = \App\Models\Setting::getValue('address');
    $facebookUrl = \App\Models\Setting::getValue('facebook_url');
    $linkedinUrl = \App\Models\Setting::getValue('linkedin_url');
    $instagramUrl = \App\Models\Setting::getValue('instagram_url');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! \App\Helpers\SEO::renderMetaTags($metaTitle, $metaDescription) !!}

    <style>
        :root {
            --color-primary: {{ $primaryColor }};
            --color-secondary: {{ $secondaryColor }};
            --color-accent: {{ $accentColor }};
        }
    </style>

    {!! \App\Helpers\SEO::renderJsonLd() !!}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-gray-950/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight">
                    {{ $siteName }}
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Inicio</a>
                    <a href="{{ route('portfolio') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Portafolio</a>
                    <a href="#contacto" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Contacto</a>

                    <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors" aria-label="Toggle theme">
                        <svg class="w-5 h-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                        </svg>
                        <svg class="w-5 h-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                    </button>
                </div>

                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden md:hidden pb-4 border-t border-gray-200 dark:border-gray-800">
                <div class="flex flex-col gap-2 pt-4">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Inicio</a>
                    <a href="{{ route('portfolio') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Portafolio</a>
                    <a href="#contacto" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Contacto</a>
                    <button id="theme-toggle-mobile" class="px-3 py-2 rounded-lg text-sm font-medium text-left text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        Modo oscuro
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-16">
        {{ $slot }}
    </main>

    <footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ $siteName }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $siteDescription }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Enlaces</h3>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-gray-900 dark:hover:text-white transition-colors">Inicio</a></li>
                        <li><a href="{{ route('portfolio') }}" class="hover:text-gray-900 dark:hover:text-white transition-colors">Portafolio</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contacto</h3>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        @if ($email)
                            <li><a href="mailto:{{ $email }}" class="hover:text-gray-900 dark:hover:text-white transition-colors">{{ $email }}</a></li>
                        @endif
                        @if ($phone)
                            <li><a href="tel:{{ $phone }}" class="hover:text-gray-900 dark:hover:text-white transition-colors">{{ $phone }}</a></li>
                        @endif
                        @if ($address)
                            <li class="text-gray-600 dark:text-gray-400">{{ $address }}</li>
                        @endif
                    </ul>
                    <div class="flex gap-4 mt-4">
                        @if ($facebookUrl)
                            <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            </a>
                        @endif
                        @if ($linkedinUrl)
                            <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        @endif
                        @if ($instagramUrl)
                            <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-800 mt-8 pt-8 text-center text-sm text-gray-500 dark:text-gray-500">
                &copy; {{ date('Y') }} {{ $siteName }}. Todos los derechos reservados.
                <span class="mx-2">&middot;</span>
                <a href="/admin" class="hover:text-gray-700 dark:hover:text-gray-300 transition-colors">Admin</a>
            </div>
        </div>
    </footer>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const themeToggleMobile = document.getElementById('theme-toggle-mobile');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }

        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        }

        themeToggle?.addEventListener('click', toggleTheme);
        themeToggleMobile?.addEventListener('click', toggleTheme);
        mobileMenuBtn?.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    </script>

    @stack('scripts')
</body>
</html>
