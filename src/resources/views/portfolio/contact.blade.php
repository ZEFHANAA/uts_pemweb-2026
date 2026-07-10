@extends('layouts.app')

@section('title', 'Kontak')
@section('meta_description', 'Hubungi Zefhana Ananda untuk pertanyaan atau masukan mengenai proyek. Email, GitHub, dan LinkedIn tersedia.')

@section('content')

<section class="pt-28 pb-8">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Kontak</h1>
        <p class="mt-3 text-white/55 max-w-lg">Punya masukan untuk project saya atau ada hal lain yang ingin dibahas? Kirim pesan saja. Biasanya saya membalas dalam 1–2 hari.</p>
    </div>
</section>

<section class="py-8 pb-24">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-[.8fr_1.2fr] gap-8">

            <div class="space-y-5">
                <div class="card p-6">
                    <h2 class="text-lg font-semibold text-white mb-5">Info kontak</h2>

                    @php
                    $contacts = [];
                    if ($profile) {
                        if ($profile->email) $contacts[] = ['label' => 'Email', 'value' => $profile->email, 'href' => 'mailto:' . $profile->email];
                        if ($profile->phone) $contacts[] = ['label' => 'Telepon', 'value' => $profile->phone, 'href' => 'tel:' . str_replace(' ', '', $profile->phone)];
                        if ($profile->location) $contacts[] = ['label' => 'Lokasi', 'value' => $profile->location, 'href' => null];
                    }
                    @endphp

                    <div class="space-y-4">
                        @foreach($contacts as $contact)
                        <div>
                            <div class="text-xs text-white/35 uppercase tracking-wider mb-1">{{ $contact['label'] }}</div>
                            @if($contact['href'])
                                <a href="{{ $contact['href'] }}" class="text-sm text-white hover:text-indigo-400 transition">{{ $contact['value'] }}</a>
                            @else
                                <p class="text-sm text-white">{{ $contact['value'] }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                @if(($profile->github_url ?? null) || ($profile->linkedin_url ?? null))
                <div class="card p-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Social</h2>
                    <div class="space-y-2">
                        @if($profile->github_url)
                        <a href="{{ $profile->github_url }}" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-white/[0.03] border border-white/[0.08] hover:bg-white/[0.06] transition text-white">
                            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            <span class="text-sm font-medium">GitHub</span>
                        </a>
                        @endif
                        @if($profile->linkedin_url)
                        <a href="{{ $profile->linkedin_url }}" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-white/[0.03] border border-white/[0.08] hover:bg-white/[0.06] transition text-white">
                            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            <span class="text-sm font-medium">LinkedIn</span>
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <div>
                <div class="card p-6 sm:p-8">
                    <h2 class="text-xl font-semibold text-white mb-1">Kirim pesan</h2>
                    <p class="text-sm text-white/40 mb-6">Tinggalkan pesan. Saya baca semuanya.</p>

                    <form action="{{ route('contact.store') }}" method="POST" id="contact-form" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-xs text-white/50 mb-1.5">Nama</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                       class="input-field @error('name') !border-red-500/50 @enderror">
                                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-xs text-white/50 mb-1.5">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                       class="input-field @error('email') !border-red-500/50 @enderror">
                                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-xs text-white/50 mb-1.5">Subjek</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                                   class="input-field @error('subject') !border-red-500/50 @enderror">
                            @error('subject') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-xs text-white/50 mb-1.5">Pesan</label>
                            <textarea id="message" name="message" rows="5" required
                                      class="input-field resize-none @error('message') !border-red-500/50 @enderror">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" id="submit-btn" class="w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3 rounded-xl transition">
                            <span id="btn-text">Kirim pesan</span>
                        </button>
                    </form>
                </div>

                @if($faqs->count() > 0)
                <div class="card p-6 mt-5">
                    <h3 class="font-semibold text-white mb-4">FAQ</h3>
                    <div class="space-y-2">
                        @foreach($faqs as $faq)
                        <details class="group rounded-xl border border-white/[0.08] bg-white/[0.02]">
                            <summary class="flex justify-between items-center p-4 cursor-pointer text-sm text-white/75 hover:text-white list-none">
                                {{ $faq->question }}
                                <svg class="w-4 h-4 text-white/30 group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </summary>
                            <div class="px-4 pb-4 text-sm text-white/50 leading-relaxed border-t border-white/[0.08] pt-3">
                                {{ $faq->answer }}
                            </div>
                        </details>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('contact-form')?.addEventListener('submit', function() {
    const btn = document.getElementById('submit-btn');
    const txt = document.getElementById('btn-text');
    btn.disabled = true;
    btn.classList.add('opacity-60', 'cursor-not-allowed');
    txt.textContent = 'Mengirim...';
});
</script>

@endsection
