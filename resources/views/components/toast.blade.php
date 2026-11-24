<div
    x-show="toastVisible"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    role="status"
    aria-live="polite"
    class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-xs sm:text-sm font-semibold shadow-xl border border-slate-700 dark:border-slate-200"
>
    <i data-lucide="check" class="w-4 h-4 text-emerald-400 dark:text-emerald-600"></i>
    <span x-text="toastMessage"></span>
</div>