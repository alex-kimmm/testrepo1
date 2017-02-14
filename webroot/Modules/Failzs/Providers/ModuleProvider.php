<?php

namespace TypiCMS\Modules\Failzs\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Failzs\Models\Failz;
use TypiCMS\Modules\Failzs\Models\FailzTranslation;
use TypiCMS\Modules\Failzs\Repositories\CacheDecorator;
use TypiCMS\Modules\Failzs\Repositories\EloquentFailz;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.failzs'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['failzs' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'failzs');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'failzs');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/failzs'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Failzs',
            'TypiCMS\Modules\Failzs\Facades\Facade'
        );

        // Observers
        FailzTranslation::observe(new SlugObserver());
        Failz::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Failzs\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Failzs\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('failzs::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('failzs');
        });

        $app->bind('TypiCMS\Modules\Failzs\Repositories\FailzInterface', function (Application $app) {
            $repository = new EloquentFailz(new Failz());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'failzs', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
