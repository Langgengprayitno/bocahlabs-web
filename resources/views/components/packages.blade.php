@props(['packages', 'waUrl' => '#'])

<section id="paket" class="py-24 bg-white/60 dark:bg-slatebg-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Split Editorial Header + Filter Tier --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
            <div class="max-w-2xl space-y-2.5">
                <p class="font-mono text-xs font-semibold uppercase tracking-[0.18em] text-brand-600 dark:text-brand-400">
                    {{ __('site.packages.badge') }}
                </p>
                <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-[-0.025em] text-slate-900 dark:text-white">
                    {{ __('site.packages.title') }}
                </h2>
                <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400">
                    {{ __('site.packages.subtitle') }}
                </p>
            </div>

            {{-- Filter Tier --}}
            <div class="shrink-0">
                <div class="inline-flex items-center gap-1 p-1 rounded-xl bg-slate-100 dark:bg-slatebg-900 border border-slate-200 dark:border-slate-800">
                    <button
                        type="button"
                        @click="activeTier = 'all'"
                        :class="activeTier === 'all' ? 'bg-brand-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white'"
                        class="tier-filter-btn px-3.5 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-colors cursor-pointer"
                    >
                        {{ __('site.packages.filter_all') }}
                    </button>
                    <button
                        type="button"
                        @click="activeTier = 'beginner'"
                        :class="activeTier === 'beginner' ? 'bg-brand-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white'"
                        class="tier-filter-btn px-3.5 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-colors cursor-pointer"
                    >
                        {{ __('site.packages.filter_beginner') }}
                    </button>
                    <button
                        type="button"
                        @click="activeTier = 'professional'"
                        :class="activeTier === 'professional' ? 'bg-brand-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white'"
                        class="tier-filter-btn px-3.5 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-colors cursor-pointer"
                    >
                        {{ __('site.packages.filter_professional') }}
                    </button>
                </div>
            </div>
        </div>

        {{-- Grid Kartu Paket --}}
        <div
            id="packages-grid"
            class="grid sm:grid-cols-2 gap-6"
            :class="filteredPackageCount <= 2 ? 'max-w-4xl mx-auto' : 'lg:grid-cols-4'"
        >
            @foreach ($packages as $index => $pkg)
                @php
                    $cardSurface = $pkg->is_popular
                        ? 'surface-popular border-2 border-brand-500/90'
                        : 'surface-card border border-slate-200/90 dark:border-slate-800/90';
                    $tierCls = $pkg->tier === 'professional'
                        ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300'
                        : 'bg-brand-100 text-brand-700 dark:bg-brand-900/50 dark:text-brand-300';
                @endphp

                <div
                    x-show="activeTier === 'all' || activeTier === '{{ $pkg->tier }}'"
                    x-transition.opacity.duration.200ms
                    data-sc-reveal="deck"
                    style="--sc-delay: {{ $index * 90 }}ms;"
                    data-package-tier="{{ $pkg->tier }}"
                    class="card-hover relative flex flex-col justify-between rounded-2xl p-6 {{ $cardSurface }}"
                >
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wide {{ $tierCls }}">
                                {{ $pkg->tier_label }}
                            </span>
                            @if ($pkg->is_popular)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-brand-600 text-white shadow-sm shadow-brand-600/30">
                                    {{ __('site.packages.popular_badge') }}
                                </span>
                            @endif
                        </div>

                        <h3 class="font-display text-lg font-bold tracking-tight text-slate-900 dark:text-white">{{ $pkg->name }}</h3>
                        <p class="mt-2 font-display tabular-nums text-xl font-extrabold tracking-tight text-brand-600 dark:text-brand-400">{{ $pkg->price_label }}</p>
                        <p class="mt-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $pkg->tagline }}</p>

                        <ul class="mt-5 pt-5 border-t border-slate-200/70 dark:border-slate-800/80 space-y-2.5 text-xs sm:text-sm text-slate-700 dark:text-slate-300">
                            @foreach ($pkg->features as $feature)
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-500 shrink-0 mt-0.5"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-6 pt-4">
                        <a
                            href="{{ $waUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            @click.prevent="openBriefModal('{{ $pkg->slug }}')"
                            data-select-package="{{ $pkg->slug }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold transition-colors {{ $pkg->is_popular ? 'bg-brand-600 hover:bg-brand-700 text-white shadow-md shadow-brand-600/25' : 'bg-slate-100 hover:bg-brand-600 text-slate-800 hover:text-white dark:bg-slate-800/90 dark:hover:bg-brand-600 dark:text-slate-100' }}"
                        >
                            <span>{{ __('site.packages.select_btn') }}</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>