<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Faq;
use App\Models\MarketingCode;
use App\Models\Package;
use App\Models\ProcessStep;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public const HOME_CACHE_KEY = 'bocahlabs_home_data';

    public function index(): View
    {
        $data = Cache::remember(self::HOME_CACHE_KEY, now()->addHour(), function (): array {
            return [
                'packages' => Package::active()->ordered()->get(),
                'addons' => Addon::active()->ordered()->get(),
                'processSteps' => ProcessStep::active()->ordered()->get(),
                'faqs' => Faq::active()->ordered()->get(),
                'settings' => Setting::allAsMap(),
                'marketingCodes' => MarketingCode::active()->get(['code', 'discount_label']),
            ];
        });

        return view('home', $data);
    }
}