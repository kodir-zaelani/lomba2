<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewsettingServiceProvider extends ServiceProvider
{
       /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       View::composer(['*'], function ($view) {
            $global_option = Setting::first();
            if (!empty($global_option)) {
                $view->with('global_option', $global_option);
            } else {
                $view->with('global_option', '0');
            }
        });
    }
}