<?php

namespace TypiCMS\Modules\Headerblocks\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Headerblocks\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('headerblocks')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.headerblocks', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.headerblocks.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/headerblocks', ['as' => 'admin.headerblocks.index', 'uses' => 'AdminController@index']);
            $router->get('admin/headerblocks/create', ['as' => 'admin.headerblocks.create', 'uses' => 'AdminController@create']);
            $router->get('admin/headerblocks/{headerblock}/edit', ['as' => 'admin.headerblocks.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/headerblocks', ['as' => 'admin.headerblocks.store', 'uses' => 'AdminController@store']);
            $router->put('admin/headerblocks/{headerblock}', ['as' => 'admin.headerblocks.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/headerblocks', ['as' => 'api.headerblocks.index', 'uses' => 'ApiController@index']);
            $router->put('api/headerblocks/{headerblock}', ['as' => 'api.headerblocks.update', 'uses' => 'ApiController@update']);
            $router->delete('api/headerblocks/{headerblock}', ['as' => 'api.headerblocks.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
