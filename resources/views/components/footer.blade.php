@props(['settings' => []])

@php
    $copyKey = 'footer_copy_' . app()->getLocale();
    $footerCopy = $settings[$copyKey] ?? __('site.footer.copy');
@endphp

<footer class="border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slatebg-950 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center bg-white rounded-full px-3 py-1 shadow-sm border border-slate-200/80 dark:border-slate-700/60">
                <img src="{{ asset('images/logo.png') }}" alt="BocahLabs Logo" class="h-6 w-auto" />
            </span>
            <p class="text-xs text-slate-500 dark:text-slate-400 max-w-sm">
                {{ __('site.footer.tagline') }}
            </p>
        </div>

        <p class="text-xs text-slate-500 dark:text-slate-400 text-center sm:text-right">
            {{ $footerCopy }}
        </p>
    </div>
</footer>