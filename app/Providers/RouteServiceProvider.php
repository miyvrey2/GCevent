<?php

namespace App\Providers;

use App\Developer;
use App\Game;
use App\Page;
use App\Article;
use App\Platform;
use App\Publisher;
use App\Serie;
use App\RSSItem;
use App\RSSWebsite;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();

        Route::bind('article', function($slug) {
//            return Article::published()->where('slug', $slug)->first();
            return Article::where('slug', $slug)->first();
        });

        Route::bind('developer', function($slug) {
            return Developer::where('slug', $slug)->first();
        });

        Route::bind('game', function($slug) {
            return Game::where('slug', $slug)->first();
        });

        Route::bind('page', function($slug) {
            return Page::published()->where('slug', $slug)->first();
        });

        Route::bind('platform', function($slug) {
            return Platform::where('slug', $slug)->first();
        });

        Route::bind('publisher', function($slug) {
            return Publisher::where('slug', $slug)->first();
        });

        Route::bind('rssitem', function($id) {
            return RSSItem::where('id', $id)->first();
        });

        Route::bind('rsswebsite', function($id) {
            return RSSWebsite::where('id', $id)->first();
        });

        Route::bind('serie', function($slug) {
            return Serie::where('slug', $slug)->first();
        });

        // Admin
        Route::bind('admin_pages', function($id) {
            return Page::where('id', $id)->first();
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
