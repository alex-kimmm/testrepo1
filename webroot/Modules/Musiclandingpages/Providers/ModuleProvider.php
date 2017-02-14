<?php

namespace TypiCMS\Modules\Musiclandingpages\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Musiclandingpages\Models\Musiclandingpage;
use TypiCMS\Modules\Musiclandingpages\Models\MusiclandingpageHomepageblock;
use TypiCMS\Modules\Musiclandingpages\Models\MusiclandingpageCard;
use TypiCMS\Modules\Musiclandingpages\Models\MusiclandingpageTranslation;
use TypiCMS\Modules\Musiclandingpages\Repositories\CacheDecorator;
use TypiCMS\Modules\Musiclandingpages\Repositories\EloquentMusiclandingpage;
use TypiCMS\Modules\Musiclandingpages\Repositories\EloquentMusiclandingpageHomepageblock;
use TypiCMS\Modules\Musiclandingpages\Repositories\EloquentMusiclandingpageCard;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.musiclandingpages'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['musiclandingpages' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'musiclandingpages');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'musiclandingpages');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/musiclandingpages'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Musiclandingpages',
            'TypiCMS\Modules\Musiclandingpages\Facades\Facade'
        );

        // Observers
        MusiclandingpageTranslation::observe(new SlugObserver());
        Musiclandingpage::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Musiclandingpages\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Musiclandingpages\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('musiclandingpages::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('musiclandingpages');
        });

        $app->bind('TypiCMS\Modules\Musiclandingpages\Repositories\MusiclandingpageInterface', function (Application $app) {
            $repository = new EloquentMusiclandingpage(new Musiclandingpage());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'musiclandingpages', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        // music landing page home page blocks
        $app->bind('TypiCMS\Modules\Musiclandingpages\Repositories\MusiclandingpageHomepageblockInterface', function (Application $app) {
            $repository = new EloquentMusiclandingpageHomepageblock(new MusiclandingpageHomepageblock());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'musiclandingpages_homepageblocks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        // music landing page cards
        $app->bind('TypiCMS\Modules\Musiclandingpages\Repositories\MusiclandingpageCardInterface', function (Application $app) {
            $repository = new EloquentMusiclandingpageCard(new MusiclandingpageCard());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'musiclandingpages_cards', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
