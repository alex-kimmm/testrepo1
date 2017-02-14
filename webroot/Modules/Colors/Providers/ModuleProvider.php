<?php

namespace TypiCMS\Modules\Colors\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Colors\Models\Color;
use TypiCMS\Modules\Colors\Models\ColorTranslation;
use TypiCMS\Modules\Colors\Repositories\CacheDecorator;
use TypiCMS\Modules\Colors\Repositories\EloquentColor;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.colors'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['colors' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'colors');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'colors');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/colors'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Colors',
            'TypiCMS\Modules\Colors\Facades\Facade'
        );

        // Observers
        ColorTranslation::observe(new SlugObserver());
        Color::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Colors\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Colors\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('colors::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('colors');
        });

        $app->bind('TypiCMS\Modules\Colors\Repositories\ColorInterface', function (Application $app) {
            $repository = new EloquentColor(new Color());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'colors', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
