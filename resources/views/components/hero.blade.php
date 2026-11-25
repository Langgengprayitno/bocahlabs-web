@props(['packages', 'settings', 'waUrl' => '#'])

@php
    $firstPackage = $packages->first();
@endphp

<section id="top" data-sc-scrub="hero" class="relative overflow-hidden hero-glow grid-pattern pt-10 pb-16 lg:pt-16 lg:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            {{-- Kolom Kiri: Copywriting & Statistik --}}
            <div class="lg:col-span-6 space-y-6 sc-hero-copy">
                <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-brand-100 dark:bg-brand-900/50 text-brand-700 dark:text-brand-200 border border-brand-200/80 dark:border-brand-700/60 shadow-sm backdrop-blur-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span>{{ __('site.hero.badge') }}</span>
                </div>

                <h1 class="font-display text-3xl sm:text-4xl lg:text-[3.25rem] font-extrabold tracking-[-0.03em] leading-[1.1] text-slate-900 dark:text-white">
                    {{ __('site.hero.title_prefix') }}
                    <span class="text-brand-600 dark:text-brand-400">
                        {{ __('site.hero.title_highlight') }}
                    </span>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-xl">
                    {{ __('site.hero.subtitle') }}
                </p>

                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <a
                        href="#paket"
                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl text-sm font-semibold bg-brand-600 hover:bg-brand-700 text-white shadow-lg shadow-brand-600/25 transition-all hover:-translate-y-0.5"
                    >
                        <span>{{ __('site.hero.cta_packages') }}</span>
                        <i data-lucide="arrow-down" class="w-4 h-4"></i>
                    </a>
                    <a
                        href="{{ $waUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        @click.prevent="openBriefModal()"
                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl text-sm font-semibold surface-card text-slate-800 dark:text-slate-100 border border-slate-200/90 dark:border-slate-700/80 hover:border-brand-500 transition-all hover:-translate-y-0.5"
                    >
                        <i data-lucide="message-circle" class="w-4 h-4 text-emerald-500"></i>
                        <span>{{ __('site.hero.cta_consult') }}</span>
                    </a>
                </div>

                {{-- 3 Statistik Hero dengan Tabular Numerals --}}
                <div class="grid grid-cols-3 gap-4 pt-6 border-t border-slate-200/80 dark:border-slate-800/80 max-w-md">
                    <div>
                        <p class="font-display tabular-nums text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('site.hero.stat_1_value') }}</p>
                        <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ __('site.hero.stat_1_label') }}</p>
                    </div>
                    <div class="border-l border-slate-200/80 dark:border-slate-800/80 pl-4">
                        <p class="font-display tabular-nums text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('site.hero.stat_2_value') }}</p>
                        <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ __('site.hero.stat_2_label') }}</p>
                    </div>
                    <div class="border-l border-slate-200/80 dark:border-slate-800/80 pl-4">
                        <p class="font-display tabular-nums text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('site.hero.stat_3_value') }}</p>
                        <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ __('site.hero.stat_3_label') }}</p>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Preview Paket dalam Bingkai Studio Browser --}}
            <div class="lg:col-span-6 sc-hero-stage">
                <div data-sc-tilt class="sc-tilt-surface surface-card rounded-2xl p-4 sm:p-5 border border-slate-200/90 dark:border-slate-800/90">
                    {{-- Header Bingkai Browser Mini --}}
                    <div class="flex items-center justify-between pb-3 mb-3.5 border-b border-slate-200/80 dark:border-slate-800/80">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-400/90"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400/90"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400/90"></span>
                        </div>
                        <span class="font-mono text-[11px] px-3 py-0.5 rounded-full bg-slate-100 dark:bg-slatebg-950 text-slate-500 dark:text-slate-400 border border-slate-200/70 dark:border-slate-800">
                            bocahlabs.id/preview
                        </span>
                        <span class="text-[11px] font-medium text-brand-600 dark:text-brand-400">Live</span>
                    </div>

                    {{-- Tab Preview 4 Paket (2x2 simetris) --}}
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        @foreach ($packages as $index => $pkg)
                            <button
                                type="button"
                                @click="heroPreviewIdx = {{ $index }}"
                                :class="heroPreviewIdx === {{ $index }}
                                    ? 'bg-brand-600 text-white shadow-sm shadow-brand-600/30 border-brand-600'
                                    : 'bg-slate-50 dark:bg-slatebg-950/80 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-slate-800 hover:border-brand-500'"
                                class="hero-tab-btn px-3 py-2 rounded-lg text-xs font-semibold border transition-colors cursor-pointer truncate"
                            >
                                {{ $pkg->name }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Gambar Preview --}}
                    @if ($firstPackage)
                        <div
                            @click="openPackageLightbox(heroPreviewIdx)"
                            class="relative aspect-square max-w-[430px] mx-auto rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-900 dark:bg-slatebg-950 flex items-center justify-center cursor-zoom-in group"
                        >
                            <img
                                id="hero-preview-img"
                                :src="currentHeroPackage ? currentHeroPackage.image_url : '{{ asset($firstPackage->image_path) }}'"
                                :alt="currentHeroPackage ? currentHeroPackage.name : '{{ $firstPackage->name }}'"
                                class="w-full h-full object-contain group-hover:scale-[1.02] transition-transform duration-300"
                            />
                        </div>
                        <div class="flex items-center justify-between gap-2 mt-3.5 text-xs text-slate-500 dark:text-slate-400">
                            <span
                                id="hero-preview-caption"
                                class="font-semibold text-slate-800 dark:text-slate-200"
                                x-text="currentHeroPackage ? (currentHeroPackage.name + ' · ' + currentHeroPackage.tier_label) : '{{ $firstPackage->name }} · {{ $firstPackage->tier_label }}'"
                            ></span>
                            <span>{{ __('site.hero.preview_hint') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>