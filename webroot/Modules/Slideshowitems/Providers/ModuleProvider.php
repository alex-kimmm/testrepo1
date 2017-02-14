<?php

namespace TypiCMS\Modules\Slideshowitems\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Slideshowitems\Models\Slideshowitem;
use TypiCMS\Modules\Slideshowitems\Models\SlideshowitemTranslation;
use TypiCMS\Modules\Slideshowitems\Repositories\CacheDecorator;
use TypiCMS\Modules\Slideshowitems\Repositories\EloquentSlideshowitem;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.slideshowitems'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['slideshowitems' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'slideshowitems');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'slideshowitems');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/slideshowitems'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Slideshowitems',
            'TypiCMS\Modules\Slideshowitems\Facades\Facade'
        );

        // Observers
        SlideshowitemTranslation::observe(new SlugObserver());
        Slideshowitem::observe(new FileObserver());
        Slideshowitem::saving(function ($slideshowitem) {
            foreach ($slideshowitem['attributes'] as $key => $value) {
                $slideshowitem->{$key} = empty($value) ? null : $value;
            }
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Slideshowitems\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Slideshowitems\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('slideshowitems::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('slideshowitems');
        });

        $app->bind('TypiCMS\Modules\Slideshowitems\Repositories\SlideshowitemInterface', function (Application $app) {
            $repository = new EloquentSlideshowitem(new Slideshowitem());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'slideshowitems', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
