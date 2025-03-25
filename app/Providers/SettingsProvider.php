<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Settings; 
use Illuminate\Support\ServiceProvider;

class SettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $main_settings = Settings::all()->pluck('value','key')->toArray();
        view::share('main_settings',$main_settings);
    }
}
