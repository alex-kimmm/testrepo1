<?php

namespace TypiCMS\Modules\Landingpages\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Landingpages\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('landingpages')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.landingpages', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.landingpages.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/landingpages', ['as' => 'admin.landingpages.index', 'uses' => 'AdminController@index']);
            $router->get('admin/landingpages/create', ['as' => 'admin.landingpages.create', 'uses' => 'AdminController@create']);
            $router->get('admin/landingpages/{landingpage}/edit', ['as' => 'admin.landingpages.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/landingpages', ['as' => 'admin.landingpages.store', 'uses' => 'AdminController@store']);
            $router->put('admin/landingpages/{landingpage}', ['as' => 'admin.landingpages.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/landingpages', ['as' => 'api.landingpages.index', 'uses' => 'ApiController@index']);
            $router->put('api/landingpages/{landingpage}', ['as' => 'api.landingpages.update', 'uses' => 'ApiController@update']);
            $router->delete('api/landingpages/{landingpage}', ['as' => 'api.landingpages.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
