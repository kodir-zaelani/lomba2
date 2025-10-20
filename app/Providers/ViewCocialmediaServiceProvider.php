<?php

namespace App\Providers;

use App\Models\Socialmedia;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewCocialmediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['*'], function ($view) {
            $social_media = Socialmedia::where('status', '1')->orderBy('name', 'asc')->get();
            if (!empty($social_media)) {
                $view->with('social_media', $social_media);
            } else {
                $view->with('social_media', '0');
            }
        });
    }
}
