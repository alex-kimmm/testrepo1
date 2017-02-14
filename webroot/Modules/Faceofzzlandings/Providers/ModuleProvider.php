<?php

namespace TypiCMS\Modules\Faceofzzlandings\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Faceofzzlandings\Models\Faceofzzlanding;
use TypiCMS\Modules\Faceofzzlandings\Models\FaceofzzlandingTranslation;
use TypiCMS\Modules\Faceofzzlandings\Repositories\CacheDecorator;
use TypiCMS\Modules\Faceofzzlandings\Repositories\EloquentFaceofzzlanding;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.faceofzzlandings'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['faceofzzlandings' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'faceofzzlandings');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'faceofzzlandings');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/faceofzzlandings'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Faceofzzlandings',
            'TypiCMS\Modules\Faceofzzlandings\Facades\Facade'
        );

        // Observers
        FaceofzzlandingTranslation::observe(new SlugObserver());
        Faceofzzlanding::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Faceofzzlandings\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Faceofzzlandings\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('faceofzzlandings::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('faceofzzlandings');
        });

        $app->bind('TypiCMS\Modules\Faceofzzlandings\Repositories\FaceofzzlandingInterface', function (Application $app) {
            $repository = new EloquentFaceofzzlanding(new Faceofzzlanding());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'faceofzzlandings', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
