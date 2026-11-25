<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Faq;
use App\Models\MarketingCode;
use App\Models\Package;
use App\Models\ProcessStep;
use App\Models\Setting;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $packages = Package::active()->ordered()->get();
        $addons = Addon::active()->ordered()->get();
        $processSteps = ProcessStep::active()->ordered()->get();
        $faqs = Faq::active()->ordered()->get();
        $settings = Setting::allAsMap();
        $marketingCodes = MarketingCode::active()->get(['code', 'discount_label']);

        return view('home', compact(
            'packages',
            'addons',
            'processSteps',
            'faqs',
            'settings',
            'marketingCodes'
        ));
    }
}