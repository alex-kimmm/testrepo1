<?php

namespace TypiCMS\Modules\Landingpages\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Landingpages\Models\Landingpage;
use TypiCMS\Modules\Landingpages\Models\LandingpageCard;
use TypiCMS\Modules\Landingpages\Models\LandingpageHomepageblock;
use TypiCMS\Modules\Landingpages\Models\LandingpageTranslation;
use TypiCMS\Modules\Landingpages\Repositories\CacheDecorator;
use TypiCMS\Modules\Landingpages\Repositories\EloquentLandingpage;
use TypiCMS\Modules\Landingpages\Repositories\EloquentLandingpageCard;
use TypiCMS\Modules\Landingpages\Repositories\EloquentLandingpageHomepageblock;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.landingpages'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['landingpages' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'landingpages');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'landingpages');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/landingpages'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Landingpages',
            'TypiCMS\Modules\Landingpages\Facades\Facade'
        );

        // Observers
        LandingpageTranslation::observe(new SlugObserver());
        Landingpage::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Landingpages\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Landingpages\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('landingpages::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('landingpages');
        });

        $app->bind('TypiCMS\Modules\Landingpages\Repositories\LandingpageInterface', function (Application $app) {
            $repository = new EloquentLandingpage(new Landingpage());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'landingpages', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        // landing page home page blocks
        $app->bind('TypiCMS\Modules\Landingpages\Repositories\LandingpageHomepageblockInterface', function (Application $app) {
            $repository = new EloquentLandingpageHomepageblock(new LandingpageHomepageblock());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'landingpages_homepageblocks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        // landing page cards
        $app->bind('TypiCMS\Modules\Landingpages\Repositories\LandingpageCardInterface', function (Application $app) {
            $repository = new EloquentLandingpageCard(new LandingpageCard());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'landingpages_cards', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
