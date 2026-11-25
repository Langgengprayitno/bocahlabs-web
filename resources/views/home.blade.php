@extends('layouts.app')

@section('title', __('site.meta_title'))

@php
    $waNumber = preg_replace('/\D+/', '', $settings['wa_number'] ?? '6285667667059');
    $waUrl = 'https://wa.me/' . $waNumber;

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
@endphp

@section('content')
    <div
        x-data="bocahLabsApp({
            lang: @js(app()->getLocale()),
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