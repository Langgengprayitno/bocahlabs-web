@props(['processSteps'])

<section id="proses" class="py-20 border-t border-slate-200/70 dark:border-slate-800/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12 space-y-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-100 text-brand-700 dark:bg-brand-900/50 dark:text-brand-200">
                {{ __('site.process.badge') }}
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                {{ __('site.process.title') }}
            </h2>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400">
                {{ __('site.process.subtitle') }}
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($processSteps as $step)
                <div class="card-hover rounded-2xl p-6 bg-white dark:bg-slatebg-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-brand-100 dark:bg-brand-900/40 text-brand-600 dark:text-brand-400 flex items-center justify-center">
                            <i data-lucide="{{ $step->icon }}" class="w-5 h-5"></i>
                        </div>
                        <span class="font-mono text-2xl font-extrabold text-slate-200 dark:text-slate-800">
                            {{ $step->number }}
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ $step->title }}</h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $step->desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>