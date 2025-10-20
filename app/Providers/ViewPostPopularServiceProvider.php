<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewPostPopularServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap services.
    */
    public function boot(): void
    {
        View::composer(['*'], function ($view) {
            $berita_populer = Post::with('postcategory', 'tags', 'author')
            ->Published()
            ->Publishedate()
            ->Popular()
            ->take(5)
            ->get();
            if (!empty($berita_populer)) {
                $view->with('berita_populer', $berita_populer);
            } else {
                $view->with('berita_populer', '0');
            }
        });
    }
}