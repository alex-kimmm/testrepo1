<?php

namespace TypiCMS\Modules\Sizes\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Sizes\Models\Size;
use TypiCMS\Modules\Sizes\Models\SizeTranslation;
use TypiCMS\Modules\Sizes\Repositories\CacheDecorator;
use TypiCMS\Modules\Sizes\Repositories\EloquentSize;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.sizes'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['sizes' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'sizes');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sizes');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/sizes'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Sizes',
            'TypiCMS\Modules\Sizes\Facades\Facade'
        );

        // Observers
        SizeTranslation::observe(new SlugObserver());
        Size::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Sizes\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Sizes\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('sizes::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('sizes');
        });

        $app->bind('TypiCMS\Modules\Sizes\Repositories\SizeInterface', function (Application $app) {
            $repository = new EloquentSize(new Size());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'sizes', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
