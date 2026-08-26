<!DOCTYPE html>
<html lang="id" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portofolio') — Zefhana Ananda</title>

    {{-- Primary Meta Tags --}}
    <meta name="title" content="@yield('title', 'Zefhana Ananda — Full-Stack Web Developer')">
    <meta name="description" content="@yield('meta_description', 'Portofolio Zefhana Ananda: Full-Stack Web Developer spesialis Laravel, PHP, Tailwind CSS, Filament, dan Docker.')">
    <meta name="theme-color" content="#0a0a0a">

    {{-- Open Graph / Facebook / WhatsApp / Telegram --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Zefhana Ananda') — Full-Stack Web Developer">
    <meta property="og:description" content="@yield('meta_description', 'Portofolio Web Zefhana Ananda. Mengembangkan aplikasi web interaktif & cepat dengan Laravel & Tailwind CSS.')">
    <meta property="og:image" content="{{ asset('og_image.png') }}">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="720">

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Zefhana Ananda') — Full-Stack Web Developer">
    <meta property="twitter:description" content="@yield('meta_description', 'Portofolio Web Zefhana Ananda. Mengembangkan aplikasi web interaktif & cepat dengan Laravel & Tailwind CSS.')">
    <meta property="twitter:image" content="{{ asset('og_image.png') }}">

    {{-- Favicon: monogram, matches the terminal palette --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 fill=%22%230a0a0a%22/><text x=%2250%22 y=%2272%22 font-size=%2266%22 font-family=%22monospace%22 font-weight=%22bold%22 fill=%22%23d4a24c%22 text-anchor=%22middle%22>Z</text></svg>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#0a0a0a] text-slate-100 font-sans antialiased min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <header class="fixed top-0 left-0 right-0 z-50 bg-[#0a0a0a]/90 backdrop-blur-sm border-b border-white/[0.08]">
        <div class="max-w-5xl mx-auto px-5 h-14 flex items-center justify-between gap-4">
            <a href="{{ route('portfolio.home') }}" class="font-mono text-sm text-white hover:text-amber-400 transition-colors">
                <span class="text-amber-500">~/</span>zefhana
            </a>

            <nav class="flex items-center gap-1">
                <a href="{{ route('portfolio.home') }}"
                   class="nav-item {{ request()->routeIs('portfolio.home') ? 'active' : '' }}">beranda</a>
                <a href="{{ route('portfolio.projects') }}"
                   class="nav-item {{ request()->routeIs('portfolio.project*') ? 'active' : '' }}">proyek</a>
                <a href="{{ route('portfolio.contact') }}"
                   class="nav-item {{ request()->routeIs('portfolio.contact') ? 'active' : '' }}">kontak</a>
            </nav>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @php $footerProfile = \App\Models\ProfileSetting::first(); @endphp
    <footer class="border-t border-white/[0.08] py-8 text-xs font-mono text-white/40">
        <div class="max-w-5xl mx-auto px-5 flex flex-col sm:flex-row justify-between items-center gap-3">
            <div>© {{ date('Y') }} Zefhana Ananda</div>
            <div class="flex items-center gap-5">
                @if($footerProfile?->github_url)
                    <a href="{{ $footerProfile->github_url }}" target="_blank" rel="noopener" class="hover:text-amber-400 transition-colors">GitHub</a>
                @endif
                @if($footerProfile?->linkedin_url)
                    <a href="{{ $footerProfile->linkedin_url }}" target="_blank" rel="noopener" class="hover:text-amber-400 transition-colors">LinkedIn</a>
                @endif
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
