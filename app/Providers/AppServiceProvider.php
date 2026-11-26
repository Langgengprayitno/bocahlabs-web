<?php

namespace App\Providers;

use App\Http\Controllers\HomeController;
use App\Models\Addon;
use App\Models\Faq;
use App\Models\MarketingCode;
use App\Models\Package;
use App\Models\ProcessStep;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $clearCache = static function (): void {
            Cache::forget(HomeController::HOME_CACHE_KEY);
        };

        foreach ([Package::class, Addon::class, ProcessStep::class, Faq::class, Setting::class, MarketingCode::class] as $model) {
            $model::saved($clearCache);
            $model::deleted($clearCache);
        }
    }
}