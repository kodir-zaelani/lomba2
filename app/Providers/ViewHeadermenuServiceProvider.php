<?php

namespace App\Providers;

use NguyenHuy\Menu\Facades\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewHeadermenuServiceProvider extends ServiceProvider
{
       /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         View::composer(['*'], function ($view) {
            $header_menu = Menu::getByName('Top Header');
            if (!empty($header_menu)) {
                $view->with('header_menu', $header_menu);
            } else {
                $view->with('header_menu', '0');
            }
        });
    }
}