@extends('layouts.app')

@section('title', __('site.meta_title'))

@php
    $locale = app()->getLocale();
    $waNumber = preg_replace('/\D+/', '', $settings['wa_number'] ?? '6285667667059');
    $waUrl = 'https://wa.me/' . $waNumber;
    $canonicalUrl = url('/');
    $ogImage = asset('images/packages/compro-mini.webp');

    $packagesPayload = $packages->map(fn ($pkg) => [
        'id' => $pkg->id,
        'slug' => $pkg->slug,
        'tier' => $pkg->tier,
        'name' => $pkg->name,
        'tier_label' => $pkg->tier_label,
        'price_label' => $pkg->price_label,
        'image_url' => asset($pkg->image_path),
    ])->values();

    $addonsPayload = $addons->map(fn ($addon) => [
        'id' => $addon->id,
        'slug' => $addon->slug,
        'name' => $addon->name,
        'price_label' => $addon->price_label,
    ])->values();

    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => $settings['brand_name'] ?? 'BocahLabs',
        'url' => $canonicalUrl,
        'logo' => asset('images/logo.png'),
        'image' => $ogImage,
        'description' => __('site.meta_description'),
        'telephone' => '+' . $waNumber,
        'areaServed' => 'ID',
        'priceRange' => 'Rp 1.500.000 - Rp 7.000.000+',
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => 'Website Development Packages',
            'itemListElement' => $packages->map(fn ($pkg) => [
                '@type' => 'Offer',
                'name' => $pkg->name,
                'description' => $pkg->tagline,
                'priceCurrency' => 'IDR',
                'price' => (string) $pkg->price_min,
            ])->values()->all(),
        ],
    ];
@endphp

@push('meta')
    <meta name="description" content="{{ __('site.meta_description') }}" />
    <link rel="canonical" href="{{ $canonicalUrl }}" />
    <link rel="alternate" hreflang="id" href="{{ url('/?lang=id') }}" />
    <link rel="alternate" hreflang="en" href="{{ url('/?lang=en') }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $canonicalUrl }}" />

    {{-- Open Graph --}}
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="BocahLabs" />
    <meta property="og:title" content="{{ __('site.meta_title') }}" />
    <meta property="og:description" content="{{ __('site.meta_description') }}" />
    <meta property="og:url" content="{{ $canonicalUrl }}" />
    <meta property="og:image" content="{{ $ogImage }}" />
    <meta property="og:locale" content="{{ $locale === 'en' ? 'en_US' : 'id_ID' }}" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ __('site.meta_title') }}" />
    <meta name="twitter:description" content="{{ __('site.meta_description') }}" />
    <meta name="twitter:image" content="{{ $ogImage }}" />

    {{-- JSON-LD ProfessionalService --}}
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@section('content')
    <div
        x-data="bocahLabsApp({
            lang: @js($locale),
            waNumber: @js($waNumber),
            leadsUrl: @js(route('leads.store')),
            copySuccessText: @js(__('site.brief.copied_toast')),
            packages: @js($packagesPayload),
            addons: @js($addonsPayload),
            marketingCodes: @js($marketingCodes),
        })"
        @keydown.escape.window="closeAllModals()"
    >
        <x-navbar :wa-url="$waUrl" />

        <main>
            <x-hero :packages="$packages" :settings="$settings" :wa-url="$waUrl" />
            <x-packages :packages="$packages" :wa-url="$waUrl" />
            <x-addons :addons="$addons" :wa-url="$waUrl" />
            <x-gallery :packages="$packages" />
            <x-process :process-steps="$processSteps" />
            <x-faq :faqs="$faqs" />
            <x-cta :wa-url="$waUrl" />
        </main>

        <x-footer :settings="$settings" />
        <x-wa-float :wa-url="$waUrl" />
        <x-brief-modal :packages="$packages" :addons="$addons" />
        <x-lightbox />
        <x-toast />
    </div>
@endsection