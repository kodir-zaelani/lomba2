<?php

namespace App\Providers;

use NguyenHuy\Menu\Facades\Menu;
use NguyenHuy\Menu\Models\Menus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewTopmenuServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['*'], function ($view) {
            $public_menu = Menu::getByName('Top Menu');
            if (!empty($public_menu)) {
                $view->with('public_menu', $public_menu);
            } else {
                $view->with('public_menu', '0');
            }
        });
    }
}