@props(['processSteps'])

<section id="proses" data-sc-scrub="process" class="py-24 border-t border-slate-200/70 dark:border-slate-800/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12 space-y-2.5">
            <p class="font-mono text-xs font-semibold uppercase tracking-[0.18em] text-brand-600 dark:text-brand-400">
                {{ __('site.process.badge') }}
            </p>
            <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-[-0.025em] text-slate-900 dark:text-white">
                {{ __('site.process.title') }}
            </h2>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400">
                {{ __('site.process.subtitle') }}
            </p>
        </div>

        {{-- Live Scroll-Scrubbed Progress Rail (Desktop) --}}
        <div class="hidden lg:block relative h-1 w-full rounded-full bg-slate-200 dark:bg-slate-800 mb-8 overflow-hidden">
            <div class="sc-process-rail-fill h-full w-full rounded-full bg-gradient-to-r from-brand-500 to-indigo-500"></div>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($processSteps as $step)
                <div
                    data-sc-step
                    class="surface-card card-hover rounded-2xl p-6 border border-slate-200/90 dark:border-slate-800/90"
                >
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-11 h-11 rounded-xl bg-brand-100 dark:bg-brand-900/40 text-brand-600 dark:text-brand-400 flex items-center justify-center">
                            <i data-lucide="{{ $step->icon }}" class="w-5 h-5"></i>
                        </div>
                        <span class="sc-step-num font-mono text-2xl font-bold text-slate-300 dark:text-slate-700 transition-colors duration-300">
                            {{ $step->number }}
                        </span>
                    </div>
                    <h3 class="font-display text-base font-bold tracking-tight text-slate-900 dark:text-white">{{ $step->title }}</h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $step->desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>