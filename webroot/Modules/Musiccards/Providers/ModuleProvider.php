<?php

namespace TypiCMS\Modules\Musiccards\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Musiccards\Models\Musiccard;
use TypiCMS\Modules\Musiccards\Models\MusiccardTranslation;
use TypiCMS\Modules\Musiccards\Repositories\CacheDecorator;
use TypiCMS\Modules\Musiccards\Repositories\EloquentMusiccard;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.musiccards'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['musiccards' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'musiccards');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'musiccards');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/musiccards'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Musiccards',
            'TypiCMS\Modules\Musiccards\Facades\Facade'
        );

        // Observers
        MusiccardTranslation::observe(new SlugObserver());
        Musiccard::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Musiccards\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Musiccards\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('musiccards::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('musiccards');
        });

        $app->bind('TypiCMS\Modules\Musiccards\Repositories\MusiccardInterface', function (Application $app) {
            $repository = new EloquentMusiccard(new Musiccard());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'musiccards', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
