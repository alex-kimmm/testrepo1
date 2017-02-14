<?php

namespace TypiCMS\Modules\Pagefailzs\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Pagefailzs\Models\Pagefailz;
use TypiCMS\Modules\Pagefailzs\Models\PagefailzTranslation;
use TypiCMS\Modules\Pagefailzs\Repositories\CacheDecorator;
use TypiCMS\Modules\Pagefailzs\Repositories\EloquentPagefailz;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.pagefailzs'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['pagefailzs' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'pagefailzs');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'pagefailzs');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/pagefailzs'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Pagefailzs',
            'TypiCMS\Modules\Pagefailzs\Facades\Facade'
        );

        // Observers
        PagefailzTranslation::observe(new SlugObserver());
        Pagefailz::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Pagefailzs\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Pagefailzs\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('pagefailzs::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('pagefailzs');
        });

        $app->bind('TypiCMS\Modules\Pagefailzs\Repositories\PagefailzInterface', function (Application $app) {
            $repository = new EloquentPagefailz(new Pagefailz());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'pagefailzs', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
