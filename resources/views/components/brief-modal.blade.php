@props(['packages', 'addons'])

<div
    x-show="briefModalOpen"
    x-cloak
    x-transition.opacity.duration.200ms
    @click.self="closeBriefModal()"
    role="dialog"
    aria-modal="true"
    aria-labelledby="brief-modal-title"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm overflow-y-auto"
>
    <div class="relative w-full max-w-xl my-8 rounded-2xl bg-white dark:bg-slatebg-900 border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
        {{-- Header Modal --}}
        <div class="flex items-start justify-between gap-4 px-6 py-5 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h2 id="brief-modal-title" class="text-lg font-extrabold text-slate-900 dark:text-white">
                    {{ __('site.brief.title') }}
                </h2>
                <p class="mt-1 text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                    {{ __('site.brief.subtitle') }}
                </p>
            </div>
            <button
                type="button"
                @click="closeBriefModal()"
                aria-label="Close"
                class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
            >
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        {{-- Body Form --}}
        <form @submit.prevent="submitBriefToWhatsApp()" class="p-6 space-y-5 max-h-[78vh] overflow-y-auto">
            {{-- Honeypot anti-bot (disembunyikan dari pengguna asli) --}}
            <input
                type="text"
                name="website"
                x-model="briefHoneypot"
                tabindex="-1"
                autocomplete="off"
                aria-hidden="true"
                class="hidden"
            />

            {{-- Nama Usaha / Brand --}}
            <div>
                <label for="brief-name" class="block text-xs font-bold uppercase tracking-wide text-slate-600 dark:text-slate-300 mb-1.5">
                    {{ __('site.brief.brand_label') }}
                </label>
                <input
                    id="brief-name"
                    type="text"
                    maxlength="150"
                    x-model="briefBrandName"
                    placeholder="{{ __('site.brief.brand_placeholder') }}"
                    class="w-full px-3.5 py-2.5 rounded-xl text-sm bg-slate-50 dark:bg-slatebg-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500"
                />
            </div>

            {{-- Pilihan Paket --}}
            <div>
                <label for="brief-package" class="block text-xs font-bold uppercase tracking-wide text-slate-600 dark:text-slate-300 mb-1.5">
                    {{ __('site.brief.package_label') }}
                </label>
                <select
                    id="brief-package"
                    x-model="selectedPackageSlug"
                    class="w-full px-3.5 py-2.5 rounded-xl text-sm bg-slate-50 dark:bg-slatebg-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
                    @foreach ($packages as $pkg)
                        <option value="{{ $pkg->slug }}">
                            {{ $pkg->name }} ({{ $pkg->price_label }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Pilihan Add-ons --}}
            <div>
                <span class="block text-xs font-bold uppercase tracking-wide text-slate-600 dark:text-slate-300 mb-2">
                    {{ __('site.brief.addons_label') }}
                </span>
                <div class="space-y-2">
                    @foreach ($addons as $addon)
                        <label class="flex items-center justify-between gap-3 p-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/70 dark:bg-slatebg-950/70 hover:border-brand-500 cursor-pointer transition-colors">
                            <span class="flex items-center gap-2.5 text-sm text-slate-800 dark:text-slate-200">
                                <input
                                    type="checkbox"
                                    value="{{ $addon->slug }}"
                                    :checked="selectedAddonSlugs.includes('{{ $addon->slug }}')"
                                    @change="toggleAddon('{{ $addon->slug }}')"
                                    class="w-4 h-4 rounded text-brand-600 border-slate-300 dark:border-slate-600 focus:ring-brand-500"
                                />
                                <span class="font-medium">{{ $addon->name }}</span>
                            </span>
                            <span class="text-xs font-semibold text-brand-600 dark:text-brand-400 shrink-0">
                                {{ $addon->price_label }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Kode Unik Tim Marketing / Potongan Harga Spesial --}}
            <div>
                <label for="brief-promo" class="block text-xs font-bold uppercase tracking-wide text-slate-600 dark:text-slate-300 mb-1.5">
                    {{ __('site.brief.promo_label') }}
                </label>
                <input
                    id="brief-promo"
                    type="text"
                    maxlength="50"
                    x-model="briefPromoCode"
                    placeholder="{{ __('site.brief.promo_placeholder') }}"
                    class="w-full px-3.5 py-2.5 rounded-xl text-sm uppercase bg-slate-50 dark:bg-slatebg-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder:normal-case placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500"
                />
                <template x-if="matchedMarketingCode">
                    <p class="mt-1.5 inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                        <span>
                            {{ __('site.brief.promo_valid') }}<span x-show="matchedMarketingCode.discount_label" x-text="': ' + matchedMarketingCode.discount_label"></span>
                        </span>
                    </p>
                </template>
            </div>

            {{-- Pratinjau Pesan WA Real-Time --}}
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs font-bold uppercase tracking-wide text-slate-600 dark:text-slate-300">
                        {{ __('site.brief.preview_label') }}
                    </span>
                    <button
                        type="button"
                        @click="copyWaMessage()"
                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline"
                    >
                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                        <span>{{ __('site.brief.copy_btn') }}</span>
                    </button>
                </div>
                <pre
                    x-text="waMessage"
                    class="w-full p-3.5 rounded-xl text-xs font-mono whitespace-pre-wrap leading-relaxed bg-slate-100 dark:bg-slatebg-950 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-200"
                ></pre>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-2">
                <button
                    type="button"
                    @click="copyWaMessage()"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:border-brand-500 transition-colors"
                >
                    <i data-lucide="copy" class="w-4 h-4"></i>
                    <span>{{ __('site.brief.copy_btn') }}</span>
                </button>

                <button
                    type="submit"
                    :disabled="isSubmittingLead"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-500 hover:bg-emerald-600 disabled:opacity-60 text-white shadow-lg shadow-emerald-600/25 transition-colors"
                >
                    <i data-lucide="send" class="w-4 h-4"></i>
                    <span x-text="isSubmittingLead ? '{{ __('site.brief.sending_btn') }}' : '{{ __('site.brief.send_btn') }}'"></span>
                </button>
            </div>
        </form>
    </div>
</div>