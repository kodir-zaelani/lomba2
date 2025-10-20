<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewPostLatestServiceProvider extends ServiceProvider
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
        View::composer(['*'], function ($view) {
            $berita_terbaru = Post::where('statuspost', '0')
            ->with('postcategory', 'tags', 'author')
            ->Published()
            ->Publishedate()
            ->latest()
            ->take(5)
            ->get();
            if (!empty($berita_terbaru)) {
                $view->with('berita_terbaru', $berita_terbaru);
            } else {
                $view->with('berita_terbaru', '0');
            }
        });
    }
}