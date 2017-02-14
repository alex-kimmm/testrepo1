<?php

namespace TypiCMS\Modules\Insuranceblocks\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Insuranceblocks\Models\Insuranceblock;
use TypiCMS\Modules\Insuranceblocks\Models\InsuranceblockTranslation;
use TypiCMS\Modules\Insuranceblocks\Repositories\CacheDecorator;
use TypiCMS\Modules\Insuranceblocks\Repositories\EloquentInsuranceblock;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.insuranceblocks'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['insuranceblocks' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'insuranceblocks');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'insuranceblocks');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/insuranceblocks'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Insuranceblocks',
            'TypiCMS\Modules\Insuranceblocks\Facades\Facade'
        );

        // Observers
        InsuranceblockTranslation::observe(new SlugObserver());
        Insuranceblock::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Insuranceblocks\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Insuranceblocks\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('insuranceblocks::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('insuranceblocks');
        });

        $app->bind('TypiCMS\Modules\Insuranceblocks\Repositories\InsuranceblockInterface', function (Application $app) {
            $repository = new EloquentInsuranceblock(new Insuranceblock());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'insuranceblocks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
