<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('meta_description', 'Portfolio profesional — developer web full-stack dengan keahlian Laravel, Vue.js, dan teknologi modern.')">

        <title>@yield('title', 'Home') — Portofolio Zefhana Ananda</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Styles & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="bg-slate-50 text-slate-900">

        <!-- ===== NAVBAR ===== -->
        <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300" aria-label="Main navigation">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <a href="{{ route('portfolio.home') }}" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-sm group-hover:bg-indigo-500 transition-colors">
                            P
                        </div>
                        <span class="text-white font-bold text-lg tracking-tight">Zefhana Ananda</span>
                    </a>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center gap-1">
                        <a href="{{ route('portfolio.home') }}" class="nav-link {{ Route::is('portfolio.home') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('portfolio.projects') }}" class="nav-link {{ Route::is('portfolio.projects') || Route::is('portfolio.project') ? 'active' : '' }}">Projects</a>
                        <a href="{{ route('portfolio.contact') }}" class="nav-link {{ Route::is('portfolio.contact') ? 'active' : '' }}">Contact</a>
                        <a href="{{ url('/admin') }}" class="ml-4 inline-flex items-center gap-1.5 bg-indigo-600/80 hover:bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition-all duration-200 border border-indigo-500/50">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                            Admin
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <button id="mobile-menu-btn" class="md:hidden text-white p-2 rounded-lg hover:bg-white/10 transition" aria-label="Toggle menu">
                        <svg id="hamburger-icon" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-slate-900/95 backdrop-blur-md border-t border-white/10">
                <div class="px-4 py-4 space-y-1">
                    <a href="{{ route('portfolio.home') }}" class="block text-slate-300 hover:text-white hover:bg-white/10 px-4 py-3 rounded-lg transition font-medium">Home</a>
                    <a href="{{ route('portfolio.projects') }}" class="block text-slate-300 hover:text-white hover:bg-white/10 px-4 py-3 rounded-lg transition font-medium">Projects</a>
                    <a href="{{ route('portfolio.contact') }}" class="block text-slate-300 hover:text-white hover:bg-white/10 px-4 py-3 rounded-lg transition font-medium">Contact</a>
                    <a href="{{ url('/admin') }}" class="block text-indigo-400 hover:text-indigo-300 hover:bg-white/10 px-4 py-3 rounded-lg transition font-medium">Admin Panel</a>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if (session('success'))
            <div id="flash-success" class="fixed top-20 right-4 z-50 bg-emerald-500 text-white px-6 py-4 rounded-xl shadow-xl flex items-center gap-3 animate-fade-up">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span class="font-medium">{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-2 hover:opacity-75">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div id="flash-error" class="fixed top-20 right-4 z-50 bg-red-500 text-white px-6 py-4 rounded-xl shadow-xl flex items-start gap-3 animate-fade-up max-w-sm">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <p class="font-semibold mb-1">Terdapat kesalahan:</p>
                    <ul class="text-sm space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- ===== FOOTER ===== -->
        <footer class="bg-slate-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <div class="md:col-span-2">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-sm">P</div>
                            <h3 class="text-xl font-bold">Zefhana Ananda</h3>
                        </div>
                        <p class="text-slate-400">Portofolio profesional Zefhana Ananda — Full-Stack Developer.</p>
                        <div class="flex gap-4 mt-6">
                            <a href="#" class="w-10 h-10 rounded-lg bg-slate-800 hover:bg-indigo-600 flex items-center justify-center transition-colors" aria-label="GitHub">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-lg bg-slate-800 hover:bg-indigo-600 flex items-center justify-center transition-colors" aria-label="LinkedIn">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-lg bg-slate-800 hover:bg-indigo-600 flex items-center justify-center transition-colors" aria-label="Twitter">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-white mb-4">Navigasi</h3>
                        <ul class="space-y-3 text-slate-400">
                            <li><a href="{{ route('portfolio.home') }}" class="hover:text-white transition">Home</a></li>
                            <li><a href="{{ route('portfolio.projects') }}" class="hover:text-white transition">Projects</a></li>
                            <li><a href="{{ route('portfolio.contact') }}" class="hover:text-white transition">Contact</a></li>
                            <li><a href="{{ url('/admin') }}" class="hover:text-white transition">Admin Panel</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-white mb-4">Tech Stack</h3>
                        <ul class="space-y-3 text-slate-400">
                            <li>Laravel / PHP</li>
                            <li>Vue.js / React</li>
                            <li>Tailwind CSS</li>
                            <li>MySQL / MariaDB</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-slate-500 text-sm">&copy; {{ date('Y') }} Zefhana Ananda. All rights reserved.</p>
                    <p class="text-slate-500 text-sm">Built with <span class="text-indigo-400">Laravel</span> + <span class="text-indigo-400">Filament</span></p>
                </div>
            </div>
        </footer>

        <script>
            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            function updateNavbar() {
                if (window.scrollY > 20) {
                    navbar.classList.add('bg-slate-900/95', 'backdrop-blur-md', 'border-b', 'border-white/10', 'shadow-xl');
                    navbar.classList.remove('bg-transparent');
                } else {
                    navbar.classList.add('bg-transparent');
                    navbar.classList.remove('bg-slate-900/95', 'backdrop-blur-md', 'border-b', 'border-white/10', 'shadow-xl');
                }
            }
            updateNavbar();
            window.addEventListener('scroll', updateNavbar);

            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu    = document.getElementById('mobile-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon     = document.getElementById('close-icon');
            mobileMenuBtn.addEventListener('click', function () {
                const isOpen = !mobileMenu.classList.contains('hidden');
                mobileMenu.classList.toggle('hidden');
                hamburgerIcon.classList.toggle('hidden', !isOpen);
                closeIcon.classList.toggle('hidden', isOpen);
            });

            // Auto-hide flash messages
            setTimeout(() => {
                document.getElementById('flash-success')?.remove();
                document.getElementById('flash-error')?.remove();
            }, 5000);

            // Scroll reveal
            const revealElements = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            revealElements.forEach(el => observer.observe(el));
        </script>
    </body>
</html>
