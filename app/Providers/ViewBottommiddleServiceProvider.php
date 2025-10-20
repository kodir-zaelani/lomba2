<?php

namespace App\Providers;

use NguyenHuy\Menu\Facades\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewBottommiddleServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['*'], function ($view) {
            $bottom_middle = Menu::getByName('Bottom Middle');
            if (!empty($bottom_middle)) {
                $view->with('bottom_middle', $bottom_middle);
            } else {
                $view->with('bottom_middle', '0');
            }
        });
    }
}