@props(['faqs'])

<section id="faq" class="py-20 bg-white/60 dark:bg-slatebg-950 border-t border-slate-200/70 dark:border-slate-800/70">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 space-y-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-100 text-brand-700 dark:bg-brand-900/50 dark:text-brand-200">
                {{ __('site.faq.badge') }}
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                {{ __('site.faq.title') }}
            </h2>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400">
                {{ __('site.faq.subtitle') }}
            </p>
        </div>

        <div class="space-y-3">
            @foreach ($faqs as $index => $faq)
                <div
                    class="faq-item rounded-2xl bg-white dark:bg-slatebg-900 border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden"
                    :data-open="openFaq === {{ $index }} ? 'true' : 'false'"
                    data-open="{{ $index === 0 ? 'true' : 'false' }}"
                >
                    <button
                        type="button"
                        @click="toggleFaq({{ $index }})"
                        :aria-expanded="(openFaq === {{ $index }}).toString()"
                        class="w-full flex items-center justify-between gap-4 px-5 py-4 text-left font-semibold text-sm sm:text-base text-slate-900 dark:text-white"
                    >
                        <span>{{ $faq->question }}</span>
                        <i data-lucide="chevron-down" class="faq-chevron w-5 h-5 text-slate-400 shrink-0"></i>
                    </button>
                    <div class="faq-content">
                        <div class="faq-inner">
                            <p class="px-5 pb-5 text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>