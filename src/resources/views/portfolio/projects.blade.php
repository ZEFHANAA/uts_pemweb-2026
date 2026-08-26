@extends('layouts.app')

@section('title', 'Proyek')
@section('meta_description', 'Daftar proyek web Zefhana Ananda: Petawisata, portofolio, dan lainnya. Laravel, PHP, Filament, dan Tailwind CSS.')

@section('content')
@php
$statusConfig = [
    'completed'   => ['label' => 'selesai', 'class' => 'text-emerald-400'],
    'in-progress' => ['label' => 'berjalan', 'class' => 'text-blue-400'],
    'planning'    => ['label' => 'rencana', 'class' => 'text-amber-400'],
    'on-hold'     => ['label' => 'ditunda', 'class' => 'text-red-400'],
];
@endphp

<section class="pt-32 pb-10 border-b border-white/[0.08]">
    <div class="max-w-5xl mx-auto px-5">
        <div class="font-mono text-xs text-amber-500 mb-4">$ ls proyek/</div>
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-white">Proyek</h1>
        <p class="mt-3 max-w-lg text-sm sm:text-base leading-relaxed text-white/60">Aplikasi web yang pernah saya buat dan kembangkan.</p>
    </div>
</section>

<section class="py-12 pb-24">
    <div class="max-w-5xl mx-auto px-5">

        @if($projects->count() > 0)
        <div class="border-t border-white/[0.08]">
            @foreach($projects as $project)
            @php $cfg = $statusConfig[$project->status] ?? ['label'=>strtolower($project->status),'class'=>'text-white/50']; @endphp
            <a href="{{ route('portfolio.project', $project) }}"
               class="group flex flex-col sm:flex-row sm:items-baseline gap-2 sm:gap-6 py-5 border-b border-white/[0.08] hover:bg-white/[0.02] transition-colors px-2 -mx-2">

                <div class="font-mono text-xs text-white/30 sm:w-20 shrink-0">
                    @if($project->start_date){{ $project->start_date->format('Y') }}@endif
                </div>

                <div class="flex-grow">
                    <div class="flex items-baseline gap-3 flex-wrap">
                        <h2 class="font-bold text-base text-white group-hover:text-amber-400 transition-colors">{{ $project->title }}</h2>
                        <span class="font-mono text-[10px] {{ $cfg['class'] }}">{{ $cfg['label'] }}</span>
                        @if($project->progress < 100)
                            <span class="font-mono text-[10px] text-white/30">{{ $project->progress }}%</span>
                        @endif
                    </div>
                    <p class="mt-1.5 text-sm leading-relaxed text-white/55 max-w-2xl">{{ $project->description }}</p>
                    @if($project->technologies)
                    <div class="mt-2 font-mono text-[10px] text-white/35">
                        {{ implode(' · ', $project->technologies) }}
                    </div>
                    @endif
                </div>

                <div class="font-mono text-xs text-white/25 group-hover:text-amber-400 transition-colors shrink-0">→</div>
            </a>
            @endforeach
        </div>

        @if($projects->hasPages())
        <div class="flex justify-center mt-10">
            {{ $projects->links() }}
        </div>
        @endif

        @else
        <div class="text-center py-24 card">
            <p class="text-sm mb-6 text-white/50">Belum ada proyek.</p>
            <a href="{{ route('portfolio.home') }}" class="font-mono text-sm text-amber-400 hover:underline">← kembali</a>
        </div>
        @endif
    </div>
</section>

@endsection
