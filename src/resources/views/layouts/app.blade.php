<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('meta_description', 'Portofolio Zefhana Ananda — Full-Stack Developer, Laravel, PHP, Tailwind CSS')">
        <meta name="theme-color" content="#08090a">
        <meta name="author" content="{{ $globalProfile->name ?? 'Zefhana Ananda' }}">
        <meta property="og:title" content="@yield('title', 'Beranda') — {{ $globalProfile->name ?? 'Zefhana Ananda' }}">
        <meta property="og:description" content="@yield('meta_description', 'Portofolio Zefhana Ananda — proyek Laravel, PHP, dan aplikasi web.')">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ rtrim(config('app.url'), '/') . request()->getRequestUri() }}">
        <meta property="og:image" content="{{ rtrim(config('app.url'), '/') . '/og-image.png' }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="Portofolio Zefhana Ananda">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('title', 'Beranda') — {{ $globalProfile->name ?? 'Zefhana Ananda' }}">
        <meta name="twitter:description" content="@yield('meta_description', 'Portofolio Zefhana Ananda — proyek Laravel, PHP, dan aplikasi web.')">
        <meta name="twitter:image" content="{{ rtrim(config('app.url'), '/') . '/og-image.png' }}">
        <title>@yield('title', 'Beranda') — {{ $globalProfile->name ?? 'Zefhana Ananda' }}</title>
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

        @php
            $ldSameAs = array_filter([
                $globalProfile->github_url ?? null,
                $globalProfile->linkedin_url ?? null,
            ]);
            $ldPerson = [
                '@context' => 'https://schema.org',
                '@type' => 'Person',
                'name' => $globalProfile->name ?? 'Zefhana Ananda',
                'jobTitle' => $globalProfile->title ?? 'Full-Stack Developer',
                'email' => 'mailto:' . ($globalProfile->email ?? 'azefhana@gmail.com'),
                'url' => rtrim(config('app.url'), '/'),
            ];
            if (!empty($ldSameAs)) $ldPerson['sameAs'] = array_values($ldSameAs);
        @endphp
        <script type="application/ld+json">
        {!! json_encode($ldPerson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#08090a] text-white antialiased selection:bg-indigo-500/30">

        {{-- NAV --}}
        <nav class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-[#08090a]/80 backdrop-blur-lg">
            <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4">
                <a href="{{ route('portfolio.home') }}" class="inline-flex items-center gap-2 text-lg font-bold tracking-tight text-white">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-xs font-bold text-white">
                        {{ $globalProfile ? collect(explode(' ', $globalProfile->name))->map(fn($n) => $n[0])->first() : 'Z' }}
                    </span>
                    {{ $globalProfile->name ?? 'Zefhana' }}
                </a>

                <div class="hidden items-center gap-1 md:flex">
                    <a href="{{ route('portfolio.home') }}" class="nav-item {{ Route::is('portfolio.home') ? 'active' : '' }}">Beranda</a>
                    <a href="{{ route('portfolio.projects') }}" class="nav-item {{ Route::is('portfolio.projects') || Route::is('portfolio.project') ? 'active' : '' }}">Proyek</a>
                    <a href="{{ route('portfolio.contact') }}" class="nav-item {{ Route::is('portfolio.contact') ? 'active' : '' }}">Kontak</a>
                    @auth
                    <a href="{{ url('/admin') }}" class="ml-3 inline-flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-sm font-medium text-white hover:bg-white/15 transition">
                        Admin
                    </a>
                    @endauth
                </div>

                <button id="menu-btn" class="flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-white md:hidden">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
            <div id="mobile-menu" class="hidden border-t border-white/10 px-4 pb-4 pt-2 md:hidden">
                <a href="{{ route('portfolio.home') }}" class="block rounded-lg px-4 py-2.5 text-sm text-white/70 hover:bg-white/5">Beranda</a>
                <a href="{{ route('portfolio.projects') }}" class="block rounded-lg px-4 py-2.5 text-sm text-white/70 hover:bg-white/5">Proyek</a>
                <a href="{{ route('portfolio.contact') }}" class="block rounded-lg px-4 py-2.5 text-sm text-white/70 hover:bg-white/5">Kontak</a>
            </div>
        </nav>

        {{-- FLASH --}}
        @if (session('success'))
            <div id="flash" class="fixed right-4 top-20 z-50 flex items-center gap-3 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-400 shadow-lg backdrop-blur">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if ($errors ?? null and $errors->any())
            <div id="flash" class="fixed right-4 top-20 z-50 max-w-sm rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-400 shadow-lg backdrop-blur">
                @foreach ($errors->all() as $error)
                    <div>- {{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- MAIN --}}
        <main>
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer class="border-t border-white/10 bg-[#08090a]">
            <div class="mx-auto max-w-6xl px-4 py-10">
                <div class="flex flex-col items-center justify-between gap-3 sm:flex-row">
                    <div class="text-sm text-white/40">
                        &copy; {{ date('Y') }} {{ $globalProfile->name ?? 'Zefhana Ananda' }}
                    </div>
                    <div class="flex items-center gap-4 text-sm text-white/40">
                        @if(isset($globalProfile) && $globalProfile->github_url)
                            <a href="{{ $globalProfile->github_url }}" target="_blank" class="hover:text-white transition">GitHub</a>
                        @endif
                        @if(isset($globalProfile) && $globalProfile->linkedin_url)
                            <a href="{{ $globalProfile->linkedin_url }}" target="_blank" class="hover:text-white transition">LinkedIn</a>
                        @endif
                    </div>
                </div>
            </div>
        </footer>

        <script>
            document.getElementById('menu-btn')?.addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });
            document.querySelectorAll('.mobile-menu a').forEach(a => {
                a.addEventListener('click', () => document.getElementById('mobile-menu').classList.add('hidden'));
            });
            setTimeout(() => document.getElementById('flash')?.remove(), 4000);
        </script>
        @yield('scripts')
    </body>
</html>
