<?php

namespace TypiCMS\Modules\Gradients\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Gradients\Models\Gradient;
use TypiCMS\Modules\Gradients\Models\GradientTranslation;
use TypiCMS\Modules\Gradients\Repositories\CacheDecorator;
use TypiCMS\Modules\Gradients\Repositories\EloquentGradient;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.gradients'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['gradients' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'gradients');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'gradients');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/gradients'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Gradients',
            'TypiCMS\Modules\Gradients\Facades\Facade'
        );

        // Observers
        GradientTranslation::observe(new SlugObserver());
        Gradient::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Gradients\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Gradients\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('gradients::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('gradients');
        });

        $app->bind('TypiCMS\Modules\Gradients\Repositories\GradientInterface', function (Application $app) {
            $repository = new EloquentGradient(new Gradient());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'gradients', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
