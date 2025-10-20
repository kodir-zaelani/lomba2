<?php

namespace App\Providers;

use NguyenHuy\Menu\Facades\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewBottomrightServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['*'], function ($view) {
            $bottom_right = Menu::getByName('Bottom Right');
            if (!empty($bottom_right)) {
                $view->with('bottom_right', $bottom_right);
            } else {
                $view->with('bottom_right', '0');
            }
        });
    }
}
