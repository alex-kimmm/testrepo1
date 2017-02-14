<?php

namespace TypiCMS\Modules\Musiclandingpages\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Musiclandingpages\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {

            /*
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('musiclandingpages')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.musiclandingpages', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.musiclandingpages.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/musiclandingpages', ['as' => 'admin.musiclandingpages.index', 'uses' => 'AdminController@index']);
            $router->get('admin/musiclandingpages/create', ['as' => 'admin.musiclandingpages.create', 'uses' => 'AdminController@create']);
            $router->get('admin/musiclandingpages/{musiclandingpage}/edit', ['as' => 'admin.musiclandingpages.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/musiclandingpages', ['as' => 'admin.musiclandingpages.store', 'uses' => 'AdminController@store']);
            $router->put('admin/musiclandingpages/{musiclandingpage}', ['as' => 'admin.musiclandingpages.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/musiclandingpages', ['as' => 'api.musiclandingpages.index', 'uses' => 'ApiController@index']);
            $router->put('api/musiclandingpages/{musiclandingpage}', ['as' => 'api.musiclandingpages.update', 'uses' => 'ApiController@update']);
            $router->delete('api/musiclandingpages/{musiclandingpage}', ['as' => 'api.musiclandingpages.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
