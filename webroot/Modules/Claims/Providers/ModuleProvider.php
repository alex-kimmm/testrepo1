<?php

namespace TypiCMS\Modules\Claims\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Claims\Models\ClaimGadget;
use TypiCMS\Modules\Claims\Repositories\ClaimGadgetCacheDecorator;
use TypiCMS\Modules\Claims\Repositories\EloquentClaimGadget;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Claims\Models\Claim;
use TypiCMS\Modules\Claims\Models\ClaimTranslation;
use TypiCMS\Modules\Claims\Repositories\CacheDecorator;
use TypiCMS\Modules\Claims\Repositories\EloquentClaim;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.claims'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['claims' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'claims');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'claims');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/claims'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Claims',
            'TypiCMS\Modules\Claims\Facades\Facade'
        );

        // Observers
        ClaimTranslation::observe(new SlugObserver());
        Claim::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Claims\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Claims\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('claims::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('claims');
        });

        $app->bind('TypiCMS\Modules\Claims\Repositories\ClaimInterface', function (Application $app) {
            $repository = new EloquentClaim(new Claim());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'claims', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        $app->bind('TypiCMS\Modules\Claims\Repositories\ClaimGadgetInterface', function (Application $app) {
            $repository = new EloquentClaimGadget(new ClaimGadget());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'claims', 10);

            return new ClaimGadgetCacheDecorator($repository, $laravelCache);
        });
    }
}
