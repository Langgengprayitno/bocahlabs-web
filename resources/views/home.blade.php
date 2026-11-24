@extends('layouts.app')

@section('title', __('site.meta_title'))

@php
    $waNumber = $settings['wa_number'] ?? '6285667667059';
    $waUrl = 'https://wa.me/' . preg_replace('/\D+/', '', $waNumber);
@endphp

@section('content')
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
@endsection