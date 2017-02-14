<?php

namespace TypiCMS\Modules\Usertitles\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Usertitles\Models\Usertitle;
use TypiCMS\Modules\Usertitles\Models\UsertitleTranslation;
use TypiCMS\Modules\Usertitles\Repositories\CacheDecorator;
use TypiCMS\Modules\Usertitles\Repositories\EloquentUsertitle;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.usertitles'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['usertitles' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'usertitles');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'usertitles');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/usertitles'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Usertitles',
            'TypiCMS\Modules\Usertitles\Facades\Facade'
        );

        // Observers
        UsertitleTranslation::observe(new SlugObserver());
        Usertitle::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Usertitles\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Usertitles\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('usertitles::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('usertitles');
        });

        $app->bind('TypiCMS\Modules\Usertitles\Repositories\UsertitleInterface', function (Application $app) {
            $repository = new EloquentUsertitle(new Usertitle());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'usertitles', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
