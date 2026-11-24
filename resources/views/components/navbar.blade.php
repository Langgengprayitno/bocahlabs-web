@props(['waUrl' => '#'])

<header class="sticky top-0 z-40 backdrop-blur-md bg-white/85 dark:bg-slatebg-950/80 border-b border-slate-200/80 dark:border-slate-800/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 gap-3">
            {{-- Brand Logo --}}
            <a href="#top" class="flex items-center gap-2.5 shrink-0 focus:outline-none">
                <span class="inline-flex items-center bg-white rounded-full px-3 py-1 shadow-sm border border-slate-200/80 dark:border-slate-700/60">
                    <img src="{{ asset('images/logo.png') }}" alt="BocahLabs Logo" class="h-7 w-auto" />
                </span>
            </a>

            {{-- Navigasi Desktop --}}
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600 dark:text-slate-300">
                <a href="#paket" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">{{ __('site.nav.packages') }}</a>
                <a href="#addons" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">{{ __('site.nav.addons') }}</a>
                <a href="#galeri" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">{{ __('site.nav.gallery') }}</a>
                <a href="#proses" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">{{ __('site.nav.process') }}</a>
                <a href="#faq" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">{{ __('site.nav.faq') }}</a>
            </nav>

            {{-- Kontrol Kanan: Bahasa, Tema, CTA --}}
            <div class="flex items-center gap-2">
                {{-- Switcher Bahasa ID / EN --}}
                <div class="inline-flex items-center rounded-lg p-0.5 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs font-semibold">
                    <a
                        href="{{ route('lang.switch', 'id') }}"
                        class="px-2 py-1 rounded-md transition-colors {{ app()->getLocale() === 'id' ? 'bg-brand-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white' }}"
                    >ID</a>
                    <a
                        href="{{ route('lang.switch', 'en') }}"
                        class="px-2 py-1 rounded-md transition-colors {{ app()->getLocale() === 'en' ? 'bg-brand-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white' }}"
                    >EN</a>
                </div>

                {{-- Toggle Tema Alpine.js --}}
                <button
                    type="button"
                    @click="toggleTheme()"
                    aria-label="Toggle Theme"
                    class="p-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:border-brand-500 transition-colors"
                >
                    <i data-lucide="sun" class="w-4 h-4 hidden dark:block"></i>
                    <i data-lucide="moon" class="w-4 h-4 block dark:hidden"></i>
                </button>

                {{-- CTA Desktop --}}
                <a
                    href="{{ $waUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold bg-brand-600 hover:bg-brand-700 text-white shadow-sm shadow-brand-600/20 transition-colors"
                >
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>{{ __('site.nav.consult') }}</span>
                </a>

                {{-- Tombol Menu Mobile --}}
                <button
                    type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    :aria-expanded="mobileMenuOpen.toString()"
                    aria-label="Menu"
                    class="md:hidden p-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200"
                >
                    <i data-lucide="menu" class="w-5 h-5" x-show="!mobileMenuOpen"></i>
                    <i data-lucide="x" class="w-5 h-5" x-show="mobileMenuOpen" x-cloak></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Drawer Menu Mobile --}}
    <div
        x-show="mobileMenuOpen"
        x-cloak
        x-transition
        class="md:hidden border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slatebg-950 px-4 py-4 space-y-2"
    >
        <a href="#paket" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ __('site.nav.packages') }}</a>
        <a href="#addons" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ __('site.nav.addons') }}</a>
        <a href="#galeri" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ __('site.nav.gallery') }}</a>
        <a href="#proses" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ __('site.nav.process') }}</a>
        <a href="#faq" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">{{ __('site.nav.faq') }}</a>
        <div class="pt-2 border-t border-slate-200 dark:border-slate-800">
            <a
                href="{{ $waUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                @click="mobileMenuOpen = false"
                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold bg-brand-600 hover:bg-brand-700 text-white"
            >
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>{{ __('site.nav.consult') }}</span>
            </a>
        </div>
    </div>
</header>