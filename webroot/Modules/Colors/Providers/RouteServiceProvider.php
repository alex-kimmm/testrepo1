<?php

namespace TypiCMS\Modules\Colors\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Colors\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('colors')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.colors', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.colors.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/colors', ['as' => 'admin.colors.index', 'uses' => 'AdminController@index']);
            $router->get('admin/colors/create', ['as' => 'admin.colors.create', 'uses' => 'AdminController@create']);
            $router->get('admin/colors/{color}/edit', ['as' => 'admin.colors.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/colors', ['as' => 'admin.colors.store', 'uses' => 'AdminController@store']);
            $router->put('admin/colors/{color}', ['as' => 'admin.colors.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/colors', ['as' => 'api.colors.index', 'uses' => 'ApiController@index']);
            $router->put('api/colors/{color}', ['as' => 'api.colors.update', 'uses' => 'ApiController@update']);
            $router->delete('api/colors/{color}', ['as' => 'api.colors.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
