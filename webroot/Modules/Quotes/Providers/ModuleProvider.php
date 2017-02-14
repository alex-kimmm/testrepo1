<?php

namespace TypiCMS\Modules\Quotes\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Quotes\Models\Quote;
use TypiCMS\Modules\Quotes\Models\QuoteTranslation;
use TypiCMS\Modules\Quotes\Repositories\CacheDecorator;
use TypiCMS\Modules\Quotes\Repositories\EloquentQuote;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.quotes'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['quotes' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'quotes');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'quotes');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/quotes'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Quotes',
            'TypiCMS\Modules\Quotes\Facades\Facade'
        );

        // Observers
        QuoteTranslation::observe(new SlugObserver());
        Quote::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Quotes\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Quotes\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('quotes::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('quotes');
        });

        $app->bind('TypiCMS\Modules\Quotes\Repositories\QuoteInterface', function (Application $app) {
            $repository = new EloquentQuote(new Quote());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'quotes', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
