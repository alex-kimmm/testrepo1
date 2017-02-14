<?php

namespace TypiCMS\Modules\Cards\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Cards\Models\Card;
use TypiCMS\Modules\Cards\Models\CardTranslation;
use TypiCMS\Modules\Cards\Repositories\CacheDecorator;
use TypiCMS\Modules\Cards\Repositories\EloquentCard;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.cards'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['cards' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'cards');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'cards');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/cards'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Cards',
            'TypiCMS\Modules\Cards\Facades\Facade'
        );

        // Observers
        CardTranslation::observe(new SlugObserver());
        Card::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Cards\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Cards\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('cards::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('cards');
        });

        $app->bind('TypiCMS\Modules\Cards\Repositories\CardInterface', function (Application $app) {
            $repository = new EloquentCard(new Card());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'cards', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
