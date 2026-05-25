@extends('layouts.app')

@section('title', 'Home & About')
@section('meta_description', 'Portofolio profesional Zefhana Ananda — Full-Stack Developer. Laravel, Vue.js, Tailwind CSS dan teknologi web modern.')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-slate-900">
    {{-- Background gradient blobs --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -left-40 w-80 h-80 bg-purple-600/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/3 w-64 h-64 bg-pink-600/20 rounded-full blur-3xl"></div>
        {{-- Grid pattern --}}
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-slate-800 via-slate-900 to-slate-950"></div>
        <div class="absolute inset-0" style="background-image:radial-gradient(rgba(255,255,255,.05) 1px,transparent 1px);background-size:32px 32px;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Left: Text --}}
            <div class="animate-fade-up">
                <div class="inline-flex items-center gap-2 bg-indigo-600/20 border border-indigo-500/30 text-indigo-300 text-sm font-medium px-4 py-2 rounded-full mb-6">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    Available for projects
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white leading-[1.1] mb-6">
                    Hi, I'm<br>
                    <span class="text-gradient">{{ $profile->name ?? 'Zefhana Ananda' }}</span><br>
                    <span class="text-3xl md:text-4xl font-bold text-slate-300">{{ $profile->title ?? 'Full-Stack Developer' }}</span>
                </h1>

                <p class="text-lg text-slate-400 leading-relaxed mb-8 max-w-lg">
                    {{ $profile->sub_title ?? 'Saya membangun aplikasi web yang skalabel, modern, dan berkesan — dari backend yang robust hingga UI yang elegan.' }}
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('portfolio.projects') }}" class="btn-primary pulse-glow">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0l-7-7m7 7l-7 7"/></svg>
                        Lihat Projects
                    </a>
                    <a href="{{ route('portfolio.contact') }}" class="btn-outline">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        Hubungi Saya
                    </a>
                </div>

                <div class="flex gap-8 mt-12 pt-8 border-t border-white/10">
                    <div>
                        <div class="text-3xl font-black text-white">{{ $projectCount }}+</div>
                        <div class="text-slate-500 text-sm">Projects</div>
                    </div>
                    <div>
                        <div class="text-3xl font-black text-white">{{ $profile->years_of_experience_offset ?? 2 }}+</div>
                        <div class="text-slate-500 text-sm">Tahun Belajar</div>
                    </div>
                    <div>
                        <div class="text-3xl font-black text-white">{{ $techStackCount }}+</div>
                        <div class="text-slate-500 text-sm">Tech Stack</div>
                    </div>
                </div>
            </div>

            {{-- Right: Avatar card --}}
            <div class="hidden lg:flex justify-center items-center">
                <div class="relative">
                    {{-- Glow ring --}}
                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 blur-2xl opacity-40 scale-110 float-animation"></div>
                    {{-- Card --}}
                    <div class="relative w-80 h-80 rounded-3xl glass overflow-hidden flex items-center justify-center float-animation"
                         style="background:linear-gradient(135deg,rgba(99,102,241,.2),rgba(168,85,247,.2))">
                        <div class="text-center">
                            @if($profile && $profile->avatar_path)
                                <img src="{{ asset('storage/' . $profile->avatar_path) }}" alt="{{ $profile->name }}" class="w-28 h-28 rounded-full mx-auto mb-4 object-cover shadow-xl">
                            @else
                                <div class="w-28 h-28 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 mx-auto mb-4 flex items-center justify-center text-white text-4xl font-black shadow-xl">
                                    {{ $profile ? collect(explode(' ', $profile->name))->map(fn($n) => $n[0])->take(2)->implode('') : 'ZA' }}
                                </div>
                            @endif
                            <p class="text-white font-bold text-lg">{{ $profile->name ?? 'Zefhana Ananda' }}</p>
                            <p class="text-slate-300 text-sm mt-1">{{ $profile->title ?? 'Full-Stack Developer' }}</p>
                        </div>
                    </div>

                    {{-- Floating badges --}}
                    <div class="absolute -top-4 -left-4 bg-white rounded-xl px-3 py-2 shadow-xl flex items-center gap-2 text-sm font-semibold text-slate-900">
                        <span class="text-indigo-600">⚡</span> Laravel 12
                    </div>
                    <div class="absolute -bottom-4 -right-4 bg-white rounded-xl px-3 py-2 shadow-xl flex items-center gap-2 text-sm font-semibold text-slate-900">
                        <span class="text-emerald-500">✓</span> Open to Work
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-slate-500 animate-bounce">
        <span class="text-xs tracking-widest uppercase">Scroll</span>
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>

{{-- ===== ABOUT SECTION ===== --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            {{-- Left --}}
            <div>
                <div class="reveal">
                    <span class="text-indigo-600 font-semibold text-sm uppercase tracking-widest">About Me</span>
                    <h2 class="section-title mt-2">Tentang {{ $profile ? explode(' ', $profile->name)[0] : 'Zefhana' }}</h2>
                </div>
                <div class="reveal reveal-delay-1 space-y-4 text-slate-600 leading-relaxed html-content">
                    {!! $profile->about_me ?? '' !!}
                </div>

                {{-- Experience timeline --}}
                <div class="reveal reveal-delay-2 mt-8 space-y-4">
                    @foreach($experiences as $exp)
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-{{ $exp->color }}-100 text-{{ $exp->color }}-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                {{ $exp->year }}
                            </div>
                            @if(!$loop->last)<div class="w-0.5 h-full bg-slate-100 mt-2"></div>@endif
                        </div>
                        <div class="pb-6">
                            <h4 class="font-semibold text-slate-900">{{ $exp->title }}</h4>
                            <p class="text-sm text-slate-500 mt-1">{{ $exp->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Skills --}}
            <div>
                <div class="reveal">
                    <span class="text-indigo-600 font-semibold text-sm uppercase tracking-widest">Tech Stack</span>
                    <h2 class="section-title mt-2">Keahlian</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                    @foreach($skillGroups as $i => $group)
                    @if($group['skills']->count() > 0)
                    <div class="reveal reveal-delay-{{ $i + 1 }} bg-slate-50 rounded-2xl p-5 border border-slate-100 hover:border-{{ $group['color'] }}-200 hover:bg-{{ $group['color'] }}-50/50 transition-all duration-300">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-xl">{{ $group['icon'] }}</span>
                            <h3 class="font-semibold text-slate-900">{{ $group['title'] }}</h3>
                        </div>
                        <div class="space-y-3">
                            @foreach($group['skills'] as $skill)
                            <div>
                                <div class="flex justify-between text-sm mb-1.5">
                                    <span class="text-slate-700 font-medium">{{ $skill->name }}</span>
                                    <span class="text-slate-400">{{ $skill->level }}%</span>
                                </div>
                                <div class="h-1.5 bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-{{ $group['color'] }}-500 to-{{ $group['color'] }}-400 rounded-full"
                                         style="width: {{ $skill->level }}%; transition: width 1s ease;"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                {{-- Tech tags --}}
                @if($skills->count() > 0)
                <div class="reveal mt-6 flex flex-wrap gap-2">
                    @foreach($skills->pluck('name') as $tag)
                    <span class="bg-slate-100 text-slate-600 text-xs font-medium px-3 py-1.5 rounded-lg hover:bg-indigo-100 hover:text-indigo-700 transition-colors cursor-default">{{ $tag }}</span>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ===== FEATURED PROJECTS ===== --}}
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div class="reveal">
                <span class="text-indigo-600 font-semibold text-sm uppercase tracking-widest">Work</span>
                <h2 class="section-title mt-2 mb-0">Featured Projects</h2>
            </div>
            <a href="{{ route('portfolio.projects') }}" class="reveal text-indigo-600 hover:text-indigo-800 font-semibold flex items-center gap-1 transition">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        @php
        $statusColors = [
            'completed'  => 'bg-emerald-100 text-emerald-700',
            'in-progress'=> 'bg-blue-100 text-blue-700',
            'planning'   => 'bg-amber-100 text-amber-700',
            'on-hold'    => 'bg-red-100 text-red-700',
        ];
        $gradients = [
            'from-indigo-500 to-purple-600',
            'from-purple-500 to-pink-600',
            'from-blue-500 to-indigo-600',
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($featuredProjects as $i => $project)
            <div class="reveal reveal-delay-{{ $i + 1 }} card group hover:-translate-y-2">
                {{-- Image / Gradient --}}
                <div class="h-52 bg-gradient-to-br {{ $gradients[$i % 3] }} relative overflow-hidden">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-5xl mb-2">💻</div>
                                <p class="font-semibold text-sm opacity-80">{{ $project->title }}</p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-black/10"></div>
                    @endif
                    {{-- Status badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="badge {{ $statusColors[$project->status] ?? 'bg-slate-100 text-slate-700' }}">
                            {{ ucfirst(str_replace('-', ' ', $project->status)) }}
                        </span>
                    </div>
                    {{-- Featured star --}}
                    <div class="absolute top-4 right-4 w-8 h-8 rounded-full bg-yellow-400 flex items-center justify-center text-sm shadow">⭐</div>
                </div>

                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $project->title }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4">{{ Str::limit($project->description, 90) }}</p>

                    {{-- Progress --}}
                    <div class="mb-4">
                        <div class="flex justify-between text-xs text-slate-500 mb-1.5">
                            <span>Progress</span>
                            <span class="font-semibold text-indigo-600">{{ $project->progress }}%</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full"
                                 style="width:{{ $project->progress }}%"></div>
                        </div>
                    </div>

                    {{-- Tech tags --}}
                    <div class="flex flex-wrap gap-1.5 mb-5">
                        @foreach(array_slice($project->technologies ?? [], 0, 3) as $tech)
                        <span class="badge bg-slate-100 text-slate-600">{{ $tech }}</span>
                        @endforeach
                        @if(count($project->technologies ?? []) > 3)
                        <span class="badge bg-slate-100 text-slate-400">+{{ count($project->technologies) - 3 }}</span>
                        @endif
                    </div>

                    <a href="{{ route('portfolio.project', $project) }}"
                       class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition group/link">
                        Lihat Detail
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-16">
                <div class="text-5xl mb-4">🚀</div>
                <h3 class="text-xl font-semibold text-slate-900 mb-2">Belum Ada Project</h3>
                <p class="text-slate-500">Projects akan ditampilkan di sini. Stay tuned!</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-12 reveal">
            <a href="{{ route('portfolio.projects') }}" class="btn-primary" style="background:linear-gradient(135deg,#4f46e5,#7c3aed);">
                Lihat Semua Projects
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ===== CTA SECTION ===== --}}
<section class="py-24 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 relative overflow-hidden">
    <div class="absolute inset-0" style="background-image:radial-gradient(rgba(255,255,255,.1) 1px,transparent 1px);background-size:24px 24px;"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="reveal">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-6">Punya Ide Project?</h2>
            <p class="text-xl text-indigo-100 mb-10 max-w-xl mx-auto">
                Mari berkolaborasi dan wujudkan ide Anda menjadi produk digital yang luar biasa.
            </p>
            <a href="{{ route('portfolio.contact') }}" class="inline-flex items-center gap-3 bg-white text-indigo-600 font-bold px-8 py-4 rounded-2xl hover:bg-indigo-50 transition-all duration-300 shadow-2xl hover:-translate-y-1 text-lg">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Let's Talk
            </a>
        </div>
    </div>
</section>

@endsection
