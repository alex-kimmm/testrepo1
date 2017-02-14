<?php

namespace TypiCMS\Modules\Slideshows\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Slideshows\Models\Slideshow;
use TypiCMS\Modules\Slideshows\Models\SlideshowTranslation;
use TypiCMS\Modules\Slideshows\Repositories\CacheDecorator;
use TypiCMS\Modules\Slideshows\Repositories\EloquentSlideshow;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.slideshows'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['slideshows' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'slideshows');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'slideshows');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/slideshows'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Slideshows',
            'TypiCMS\Modules\Slideshows\Facades\Facade'
        );

        // Observers
        SlideshowTranslation::observe(new SlugObserver());
        Slideshow::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Slideshows\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Slideshows\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('slideshows::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('slideshows');
        });

        $app->bind('TypiCMS\Modules\Slideshows\Repositories\SlideshowInterface', function (Application $app) {
            $repository = new EloquentSlideshow(new Slideshow());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'slideshows', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
