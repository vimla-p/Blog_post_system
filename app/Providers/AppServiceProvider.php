<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Blog;
use App\Models\BlogView;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('frontend/layouts/header', function ($view) {
            $blog = Blog::with('users', 'categories')->orderBy('created_at', 'desc')->take(3)->get();
            $view->with('data', $blog);
        });
        view()->composer('frontend/layouts/leftsidebar', function ($view) {
            $cat = Category::with('blogs')->where('is_active', true)->orderBy('name')->take(10)->get();
            $view->with('data', $cat);
        });

        view()->composer('frontend/layouts/rightsidebar', function ($view) {

            $recentBlog = Blog::orderBy('created_at', 'desc')->take(5)->get();

            // \DB::enableQueryLog(); // Enable query log

        
            // $cat=Blog::with(['blogViews' => function($query){
            //     $query->selectRaw('sum(blog_views.visited_count)')->where('blogs.id','=','blog_views.blog_id')->whereBetween('created_at', [now()->subWeeks(), now()])->groupBy('blog_views.blog_id')->orderBy('views', 'desc')->get();
            // }])->where('is_active',true)->select('id')->get();

            $cat = Blog::join('blog_views', 'blog_views.blog_id', '=', 'blogs.id')
                ->selectRaw('sum(blog_views.visited_count) as views, blogs.id,blogs.title')
                ->whereBetween('blog_views.created_at', [now()->subWeeks(), now()])
                ->where('blogs.is_active', true)
                ->groupBy('blog_views.blog_id')
                ->orderBy('views', 'desc')
                ->take(5)
                ->get();

          
            // dd(\DB::getQueryLog());

            $view->with('data', $recentBlog)->with('category', $cat);
        });
    }
}
