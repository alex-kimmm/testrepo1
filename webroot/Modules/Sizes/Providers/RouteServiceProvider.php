<?php

namespace TypiCMS\Modules\Sizes\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Sizes\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('sizes')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.sizes', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.sizes.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/sizes', ['as' => 'admin.sizes.index', 'uses' => 'AdminController@index']);
            $router->get('admin/sizes/create', ['as' => 'admin.sizes.create', 'uses' => 'AdminController@create']);
            $router->get('admin/sizes/{size}/edit', ['as' => 'admin.sizes.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/sizes', ['as' => 'admin.sizes.store', 'uses' => 'AdminController@store']);
            $router->put('admin/sizes/{size}', ['as' => 'admin.sizes.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/sizes', ['as' => 'api.sizes.index', 'uses' => 'ApiController@index']);
            $router->put('api/sizes/{size}', ['as' => 'api.sizes.update', 'uses' => 'ApiController@update']);
            $router->delete('api/sizes/{size}', ['as' => 'api.sizes.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
