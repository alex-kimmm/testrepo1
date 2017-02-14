<?php

namespace TypiCMS\Modules\Insurancepages\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Insurancepages\Models\Insurancepage;
use TypiCMS\Modules\Insurancepages\Models\InsurancepageTranslation;
use TypiCMS\Modules\Insurancepages\Repositories\CacheDecorator;
use TypiCMS\Modules\Insurancepages\Repositories\EloquentInsurancepage;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.insurancepages'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['insurancepages' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'insurancepages');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'insurancepages');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/insurancepages'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Insurancepages',
            'TypiCMS\Modules\Insurancepages\Facades\Facade'
        );

        // Observers
        InsurancepageTranslation::observe(new SlugObserver());
        Insurancepage::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Insurancepages\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Insurancepages\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('insurancepages::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('insurancepages');
        });

        $app->bind('TypiCMS\Modules\Insurancepages\Repositories\InsurancepageInterface', function (Application $app) {
            $repository = new EloquentInsurancepage(new Insurancepage());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'insurancepages', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
