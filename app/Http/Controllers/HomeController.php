<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Faq;
use App\Models\Package;
use App\Models\ProcessStep;
use App\Models\Setting;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman landing page utama BocahLabs.
     */
    public function index(): View
    {
        $packages = Package::active()->ordered()->get();
        $addons = Addon::active()->ordered()->get();
        $processSteps = ProcessStep::active()->ordered()->get();
        $faqs = Faq::active()->ordered()->get();
        $settings = Setting::allAsMap();

        return view('home', compact(
            'packages',
            'addons',
            'processSteps',
            'faqs',
            'settings'
        ));
    }
}