<?php

namespace App\Providers;

use NguyenHuy\Menu\Facades\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewBottomleftServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap services.
    */
    public function boot(): void
    {
        View::composer(['*'], function ($view) {
            $bottom_left = Menu::getByName('Bottom Left');
            if (!empty($bottom_left)) {
                $view->with('bottom_left', $bottom_left);
            } else {
                $view->with('bottom_left', '0');
            }
        });
    }
}