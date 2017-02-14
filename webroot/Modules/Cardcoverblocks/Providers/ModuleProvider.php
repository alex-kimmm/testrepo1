<?php

namespace TypiCMS\Modules\Cardcoverblocks\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Cardcoverblocks\Models\Cardcoverblock;
use TypiCMS\Modules\Cardcoverblocks\Models\CardcoverblockTranslation;
use TypiCMS\Modules\Cardcoverblocks\Repositories\CacheDecorator;
use TypiCMS\Modules\Cardcoverblocks\Repositories\EloquentCardcoverblock;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.cardcoverblocks'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['cardcoverblocks' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'cardcoverblocks');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'cardcoverblocks');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/cardcoverblocks'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Cardcoverblocks',
            'TypiCMS\Modules\Cardcoverblocks\Facades\Facade'
        );

        // Observers
        CardcoverblockTranslation::observe(new SlugObserver());
        Cardcoverblock::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Cardcoverblocks\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Cardcoverblocks\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('cardcoverblocks::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('cardcoverblocks');
        });

        $app->bind('TypiCMS\Modules\Cardcoverblocks\Repositories\CardcoverblockInterface', function (Application $app) {
            $repository = new EloquentCardcoverblock(new Cardcoverblock());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'cardcoverblocks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
