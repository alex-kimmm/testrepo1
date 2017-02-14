<?php

namespace TypiCMS\Modules\Homepageblocks\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Homepageblocks\Models\Homepageblock;
use TypiCMS\Modules\Homepageblocks\Models\HomepageblockCovercardblock;
use TypiCMS\Modules\Homepageblocks\Models\HomepageblockTranslation;
use TypiCMS\Modules\Homepageblocks\Repositories\CacheDecorator;
use TypiCMS\Modules\Homepageblocks\Repositories\EloquentHomepageblock;
use TypiCMS\Modules\Homepageblocks\Repositories\EloquentHomepageblockCoverCardBlock;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.homepageblocks'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['homepageblocks' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'homepageblocks');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'homepageblocks');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/homepageblocks'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Homepageblocks',
            'TypiCMS\Modules\Homepageblocks\Facades\Facade'
        );

        // Observers
        HomepageblockTranslation::observe(new SlugObserver());
        Homepageblock::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Homepageblocks\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Homepageblocks\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('homepageblocks::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('homepageblocks');
        });

        $app->bind('TypiCMS\Modules\Homepageblocks\Repositories\HomepageblockInterface', function (Application $app) {
            $repository = new EloquentHomepageblock(new Homepageblock());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'homepageblocks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
