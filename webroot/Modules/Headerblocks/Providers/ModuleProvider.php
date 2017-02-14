<?php

namespace TypiCMS\Modules\Headerblocks\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Headerblocks\Models\Headerblock;
use TypiCMS\Modules\Headerblocks\Models\HeaderblockTranslation;
use TypiCMS\Modules\Headerblocks\Repositories\CacheDecorator;
use TypiCMS\Modules\Headerblocks\Repositories\EloquentHeaderblock;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.headerblocks'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['headerblocks' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'headerblocks');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'headerblocks');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/headerblocks'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Headerblocks',
            'TypiCMS\Modules\Headerblocks\Facades\Facade'
        );

        // Observers
        HeaderblockTranslation::observe(new SlugObserver());
        Headerblock::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Headerblocks\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Headerblocks\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('headerblocks::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('headerblocks');
        });

        $app->bind('TypiCMS\Modules\Headerblocks\Repositories\HeaderblockInterface', function (Application $app) {
            $repository = new EloquentHeaderblock(new Headerblock());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'headerblocks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
