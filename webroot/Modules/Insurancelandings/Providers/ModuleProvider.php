<?php

namespace TypiCMS\Modules\Insurancelandings\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Insurancelandings\Models\Insurancelanding;
use TypiCMS\Modules\Insurancelandings\Models\InsurancelandingCard;
use TypiCMS\Modules\Insurancelandings\Models\InsurancelandingCoverCard;
use TypiCMS\Modules\Insurancelandings\Models\InsurancelandingHomepageblock;
use TypiCMS\Modules\Insurancelandings\Models\InsurancelandingTranslation;
use TypiCMS\Modules\Insurancelandings\Repositories\CacheDecorator;
use TypiCMS\Modules\Insurancelandings\Repositories\EloquentInsurancelanding;
use TypiCMS\Modules\Insurancelandings\Repositories\EloquentInsurancelandingCard;
use TypiCMS\Modules\Insurancelandings\Repositories\EloquentInsurancelandingCovercard;
use TypiCMS\Modules\Insurancelandings\Repositories\EloquentInsurancelandingHomepageblock;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.insurancelandings'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['insurancelandings' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'insurancelandings');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'insurancelandings');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/insurancelandings'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Insurancelandings',
            'TypiCMS\Modules\Insurancelandings\Facades\Facade'
        );

        // Observers
        InsurancelandingTranslation::observe(new SlugObserver());
        Insurancelanding::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Insurancelandings\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Insurancelandings\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('insurancelandings::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('insurancelandings');
        });

        $app->bind('TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingInterface', function (Application $app) {
            $repository = new EloquentInsurancelanding(new Insurancelanding());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'insurancelandings', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        // home page blocks
        $app->bind('TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingHomepageblockInterface', function (Application $app) {
            $repository = new EloquentInsurancelandingHomepageblock(new InsurancelandingHomepageblock());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'insurancelandings_homepageblocks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        // cards
        $app->bind('TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingCardInterface', function (Application $app) {
            $repository = new EloquentInsurancelandingCard(new InsurancelandingCard());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'insurancelandings_cards', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        // cover cards
        $app->bind('TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingCovercardInterface', function (Application $app) {
            $repository = new EloquentInsurancelandingCovercard(new InsurancelandingCoverCard());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'insurancelandings_cardcoverblocks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
