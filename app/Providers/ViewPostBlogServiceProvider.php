<?php

namespace App\Providers;

use App\Models\Blog;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewPostBlogServiceProvider extends ServiceProvider
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
            $blog_terbaruc = Blog::with('blogcategory', 'tags', 'author')
            ->Published()
            ->Publishedate()
            ->Popular()
            ->latest()
            ->take(5)
            ->get();
            if (!empty($blog_terbaruc)) {
                $view->with('blog_terbaruc', $blog_terbaruc);
            } else {
                $view->with('blog_terbaruc', '0');
            }
        });
    }
}